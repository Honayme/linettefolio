<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeContentResource\Pages;
use App\Filament\Resources\HomeContentResource\RelationManagers;
use App\Models\HomeContent;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeContentResource extends Resource
{
    protected static ?string $model = HomeContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Page d\'Accueil';

    protected static ?string $modelLabel = 'Contenu de la page d\'accueil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make('Contenu Textuel')
                            ->schema([
                                TextInput::make('greeting_text')
                                    ->label('Texte de salutation')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Hey! I\'m Michel'),

                                TextInput::make('main_title')
                                    ->label('Titre principal')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Digital Designer'),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->rows(4)
                                    ->placeholder('I specialize in crafting user‑centered digital experiences...'),

                                TextInput::make('cta_button_text')
                                    ->label('Texte du bouton CTA')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Let\'s Contact'),

                                TextInput::make('cta_button_url')
                                    ->label('URL du bouton CTA')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('/contact'),
                            ])
                    ])
                    ->columnSpan(2),

                Grid::make()
                    ->schema([
                        Section::make('Image Hero')
                            ->schema([
                                FileUpload::make('hero_image')
                                    ->label('Image de bannière')
                                    ->image()
                                    ->directory('home-images')
                                    ->imageEditor()
                                    ->hint(new \Illuminate\Support\HtmlString('Pour optimiser votre image: <a href="https://squoosh.app/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Squoosh</a>'))
                                    ->required(),

                                TextInput::make('hero_image_alt')
                                    ->label('Texte alternatif de l\'image')
                                    ->maxLength(255)
                                    ->placeholder('Hero image'),
                            ])
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('greeting_text')
                    ->label('Salutation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('main_title')
                    ->label('Titre principal')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('hero_image')
                    ->label('Image'),
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
            'index' => Pages\ListHomeContents::route('/'),
            'edit' => Pages\EditHomeContent::route('/{record}/edit'),
        ];
    }
}
