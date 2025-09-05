<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Colonne principale (2/3 de la largeur)
                Grid::make()
                    ->schema([
                        Section::make('Contenu Principal')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre du service')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true), // Utile pour générer un slug par exemple

                                Textarea::make('excerpt')
                                    ->label('Extrait (description courte)')
                                    ->rows(3)
                                    ->required()
                                    ->maxLength(65535),

                                MarkdownEditor::make('full_content')
                                    ->label('Contenu complet')
                                    ->required()
                                    ->columnSpanFull()
                                    ->reactive(), // <-- C'EST LA CLÉ MAGIQUE !


                                // 2. Le conteneur pour l'aperçu
                                Placeholder::make('preview')
                                    ->label('Aperçu en direct')
                                    ->columnSpanFull() // Prend aussi toute la largeur
                                    // On cache l'aperçu sur la page de création tant qu'il n'y a rien à afficher
                                    ->hidden(fn (string $operation) => $operation === 'create')
                                    ->content(function ($get) {
                                        // On récupère le contenu actuel de l'éditeur
                                        $markdown = $get('full_content');
                                        if (!$markdown) {
                                            return new HtmlString('<div class="text-gray-500">L\'aperçu apparaîtra ici...</div>');
                                        }

                                        // On convertit le Markdown en HTML
                                        $html = Str::markdown($markdown);

                                        // On retourne le HTML pour qu'il soit affiché
                                        // HtmlString est CRUCIAL pour que le HTML ne soit pas échappé
                                        return new HtmlString($html);
                                    }),

                            ])
                    ])
                    ->columnSpan(2),

                // Colonne latérale (1/3 de la largeur)
                Grid::make()
                    ->schema([
                        Section::make('Métadonnées')
                            ->schema([
                                TextInput::make('display_order')
                                    ->label('Ordre d\'affichage')
                                    ->required()
                                    ->numeric()
                                    ->default(0),

                                FileUpload::make('image_path')
                                    ->label('Image de présentation')
                                    ->image()
                                    ->imageEditor() // Active un éditeur d'image simple (rogner, pivoter...)
                                    ->directory('service-images') // Stocke les images dans 'storage/app/public/service-images'
                                    ->preserveFilenames(),
                            ])
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3); // Définit la grille principale sur 3 colonnes
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('display_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
