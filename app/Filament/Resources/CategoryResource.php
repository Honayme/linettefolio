<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Grouping\Group; // Important : Importer la classe Group
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $modelLabel = 'Catégorie';
    protected static ?string $pluralModelLabel = 'Catégories';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Applique un tri par défaut pour toujours afficher les parents en premier.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()

            ->orderByRaw('parent_id IS NOT NULL')
            // Ensuite, trie les parents par leur colonne d'ordre.
            ->orderBy('order_column', 'asc')
            // Et enfin, trie les enfants par leur nom.
            ->orderBy('name', 'asc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom de la catégorie')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Category::class, 'slug', ignoreRecord: true),
                    ]),

                Forms\Components\Section::make('Positionnement')
                    ->description("Indiquez s'il s'agit d'une catégorie principale ou d'une sous-catégorie.")
                    ->schema([
                        Forms\Components\Select::make('parent_id')
                            ->label('Catégorie Parente')
                            // La modification de la relation empêche de sélectionner la catégorie actuelle (ou ses enfants) comme parent,
                            // évitant ainsi les boucles infinies.
                            ->relationship(
                                name: 'parent',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query, ?Category $record) => $query->when(
                                    $record,
                                    fn ($query) => $query->where('id', '!=', $record->id)
                                )
                            )
                            ->searchable()
                            ->placeholder('Aucune (catégorie principale)')
                            // ->live() est essentiel. Il déclenche la mise à jour du formulaire
                            // dès que ce champ est modifié.
                            ->live(),

                        Forms\Components\TextInput::make('order_column')
                            ->label('Ordre d\'affichage')
                            ->numeric()
                            ->default(0)
                            ->helperText('Uniquement pour les catégories principales.')
                            // Le champ est requis SEULEMENT si c'est une catégorie principale.
                            ->required(fn (Get $get): bool => $get('parent_id') === null)
                            // Le champ est visible SEULEMENT si 'parent_id' n'est pas défini.
                            ->visible(fn (Get $get): bool => $get('parent_id') === null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Catégorie Parente')
                    // Affiche le nom du parent OU un tiret si c'est une catégorie principale
                    ->formatStateUsing(function ($state, Category $record): string {
                        return $record->parent_id !== null ? $state : '—';
                    })
                    ->badge() // Le badge rend le nom du parent plus discret et joli
                    ->searchable(),

                Tables\Columns\TextColumn::make('order_column')
                    ->label('Ordre')
                    ->alignCenter() // Centre le contenu de la colonne
                    // Affiche le numéro d'ordre OU un tiret si c'est une sous-catégorie
                    ->formatStateUsing(function ($state, Category $record): string {
                        return $record->parent_id === null ? $state : '—';
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Dernière modification')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            // On conserve le regroupement et le tri pour la structure visuelle
            ->groups([
                Tables\Grouping\Group::make('parent.name')
                    ->label('Catégorie Parente')
                    ->getTitleFromRecordUsing(fn (Category $record): string => $record->parent_id === null ? 'Catégories Principales' : $record->parent->name)
                    ->collapsible(),
            ])
            ->reorderable('order_column');
    }

    public static function getRelations(): array
    {
        return [
            // Pour une gestion plus avancée, vous pourriez créer un RelationManager pour les enfants ici.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
