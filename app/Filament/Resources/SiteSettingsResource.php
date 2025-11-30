<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingsResource\Pages;
use App\Filament\Resources\SiteSettingsResource\RelationManagers;
use App\Models\SiteSettings;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteSettingsResource extends Resource
{
    protected static ?string $model = SiteSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Paramètres du site';
    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Paramètres du site';
    protected static ?string $pluralModelLabel = 'Paramètres du site';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make('Logo du site')
                            ->description('Téléchargez le logo principal de votre site')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Logo')
                                    ->image()
                                    ->directory('site-settings')
                                    ->imageEditor()
                                    ->hint(new \Illuminate\Support\HtmlString('Pour optimiser votre image: <a href="https://squoosh.app/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Squoosh</a>'))
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/svg+xml'])
                                    ->helperText('Formats acceptés : PNG, JPG, SVG. Taille max : 2MB'),

                                TextInput::make('logo_alt')
                                    ->label('Texte alternatif du logo')
                                    ->maxLength(255)
                                    ->placeholder('Logo du site')
                                    ->helperText('Important pour l\'accessibilité et le SEO'),
                            ])
                            ->columnSpan(2),
                    ])
                    ->columns(3),

                Grid::make()
                    ->schema([
                        Section::make('Favicon')
                            ->description('Téléchargez le favicon de votre site (icône affichée dans l\'onglet du navigateur)')
                            ->schema([
                                FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->directory('site-settings')
                                    ->imageEditor()
                                    ->maxSize(512)
                                    ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/vnd.microsoft.icon'])
                                    ->helperText('Formats acceptés : ICO, PNG. Taille recommandée : 32x32 ou 16x16 pixels. Taille max : 512KB'),
                            ])
                            ->columnSpan(1),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->size(60),
                Tables\Columns\TextColumn::make('logo_alt')
                    ->label('Alt du logo')
                    ->limit(50),
                Tables\Columns\ImageColumn::make('favicon')
                    ->label('Favicon')
                    ->size(30),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Dernière modification')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Désactivé pour éviter la suppression accidentelle
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
            'index' => Pages\ListSiteSettings::route('/'),
            'edit' => Pages\EditSiteSettings::route('/{record}/edit'),
        ];
    }

    // Désactiver la création de nouveaux enregistrements
    public static function canCreate(): bool
    {
        return false;
    }
}
