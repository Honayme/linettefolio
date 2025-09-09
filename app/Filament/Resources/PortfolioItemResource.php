<?php

namespace App\Filament\Resources;

use App\Enums\PortfolioLayout; // <-- N'oublie pas d'importer ton Enum
use App\Filament\Resources\PortfolioItemResource\Pages;
use App\Models\PortfolioItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get; // <-- Import essentiel pour les formulaires dynamiques

class PortfolioItemResource extends Resource
{
    protected static ?string $model = PortfolioItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo'; // Icône plus appropriée

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Le formulaire est maintenant divisé en 2 colonnes pour une meilleure disposition
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Détails du Projet')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titre')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Média Principal')
                            ->schema([
                                Forms\Components\Radio::make('layout')
                                    ->label('Type de Média')
                                    ->options(PortfolioLayout::class) // Utilise directement l'Enum pour les options
                                    ->required()
                                    ->live(), // <-- Très important: met à jour le formulaire en temps réel

                                // Ce champ ne s'affiche que si le layout est 'VIDEO'
                                Forms\Components\TextInput::make('video_url')
                                    ->label('URL de la Vidéo (Vimeo ou YouTube)')
                                    ->url()
                                    ->maxLength(255)
                                    ->visible(fn (Get $get): bool => $get('layout') === PortfolioLayout::VIDEO->value),

                                // Ce champ ne s'affiche que si le layout est 'GALLERY'
                                Forms\Components\FileUpload::make('images')
                                    ->label('Images de la galerie')
                                    ->multiple()
                                    ->image()
                                    ->reorderable()
                                    ->directory('portfolio-galleries')
                                    ->helperText('La première image sera utilisée pour la galerie. L\'image de couverture sera affichée sur la grille.')
                                    ->visible(fn (Get $get): bool => $get('layout') === PortfolioLayout::SLIDER->value),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // La colonne de droite pour les métadonnées
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Statut & Catégories')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label('Visible sur le site')
                                    ->default(true)
                                    ->required(),

                                // MODIFIÉ: Champ pour la relation plusieurs-à-plusieurs
                                Forms\Components\Select::make('categories')
                                    ->label('Catégories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Image de Couverture')
                            ->schema([
                                Forms\Components\FileUpload::make('cover_image')
                                    ->label('Image de couverture')
                                    ->image()
                                    ->directory('portfolio-covers')
                                    ->required(),

                                Forms\Components\TextInput::make('cover_image_alt')
                                    ->label('Texte alternatif de l\'image')
                                    ->helperText('Pour l\'accessibilité et le SEO.')
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Couverture'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                // MODIFIÉ: Affiche les catégories sous forme de badges
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Catégories')
                    ->badge()
                    ->searchable(),

                // NOUVELLE COLONNE: Affiche le layout sous forme de badge
                Tables\Columns\TextColumn::make('layout')
                    ->label('Layout')
                    ->badge()
                    ->color(fn (PortfolioLayout $state): string => match ($state->value) {
                        'video' => 'info',
                        'image' => 'success',
                        'slider' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (PortfolioLayout $state): string => ucfirst($state->value)),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolioItems::route('/'),
            'create' => Pages\CreatePortfolioItem::route('/create'),
            'edit' => Pages\EditPortfolioItem::route('/{record}/edit'),
        ];
    }
}
