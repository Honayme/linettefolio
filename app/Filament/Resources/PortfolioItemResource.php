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
use Filament\Forms\Set;
use Illuminate\Support\HtmlString;

class PortfolioItemResource extends Resource
{
    protected static ?string $model = PortfolioItem::class;
    protected static ?string $navigationLabel = 'Projets';
    protected static ?string $modelLabel = 'Projet Portfolio';
    protected static ?string $pluralModelLabel = 'Projets Portfolio';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

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

                                // Upload de vidéo simple
                                Forms\Components\FileUpload::make('video_file')
                                    ->label('Fichier Vidéo')
                                    ->directory('portfolio-videos')
                                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg', 'video/avi', 'video/mov', 'video/quicktime'])
                                    ->hint(new HtmlString('Formats acceptés: MP4, WebM, OGG, AVI, MOV. <br>Pour optimiser vos vidéos: <a href="https://tinywow.com/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">TinyWOW</a>'))
                                    ->visible(fn (Get $get): bool => $get('layout') === PortfolioLayout::VIDEO->value),

                                // Champ pour les images simples et carrousels
                                Forms\Components\FileUpload::make('images')
                                    ->label('Images du projet')
                                    ->multiple()
                                    ->reorderable()
                                    ->directory('portfolio-images')
                                    ->image()
                                    ->hint(fn (Get $get) => $get('layout') === PortfolioLayout::CARROUSEL->value
                                        ? new HtmlString('Images qui seront affichées dans le carrousel. <br>Pour optimiser vos images: <a href="https://squoosh.app/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Squoosh</a>')
                                        : new HtmlString('Images qui seront affichées dans le projet. <br>Pour optimiser vos images: <a href="https://squoosh.app/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Squoosh</a>')
                                    )
                                    ->visible(fn (Get $get): bool =>
                                        $get('layout') === PortfolioLayout::IMAGE->value ||
                                        $get('layout') === PortfolioLayout::CARROUSEL->value
                                    ),

                                Forms\Components\FileUpload::make('pdf_file')
                                    ->label('Fichier PDF de la présentation')
                                    ->directory('portfolio-presentations')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->hint(new HtmlString('Pour optimiser vos PDFs: <a href="https://tinywow.com/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">TinyWOW</a>'))
                                    ->visible(fn (Get $get): bool => $get('layout') === PortfolioLayout::PRESENTATION->value),
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
                                    ->required()
                                    ->helperText('Image qui sera affichée sur la grille du portfolio.'),

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
                        'presentation' => 'warning',
                        'carrousel' => 'purple',
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
