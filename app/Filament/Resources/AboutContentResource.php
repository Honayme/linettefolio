<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutContentResource\Pages;
use App\Filament\Resources\AboutContentResource\RelationManagers;
use App\Models\AboutContent;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutContentResource extends Resource
{
    protected static ?string $model = AboutContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Page À Propos';

    protected static ?string $modelLabel = 'Contenu de la page À propos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Contenu')
                    ->tabs([
                        // Onglet 1: Informations principales
                        Tabs\Tab::make('Informations principales')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Contenu principal')
                                            ->schema([
                                                TextInput::make('page_title')
                                                    ->label('Titre de la page')
                                                    ->required()
                                                    ->placeholder('About Me'),

                                                TextInput::make('full_name')
                                                    ->label('Nom complet')
                                                    ->required()
                                                    ->placeholder('Lina-Marie MICHEL'),

                                                TextInput::make('job_title')
                                                    ->label('Intitulé de poste')
                                                    ->required()
                                                    ->placeholder('Marketing & Communication'),

                                                Textarea::make('description')
                                                    ->label('Description')
                                                    ->required()
                                                    ->rows(4)
                                                    ->placeholder('Chargée de communication et marketing digital...'),
                                            ])
                                            ->columnSpan(1),

                                        Section::make('Image hero')
                                            ->schema([
                                                FileUpload::make('hero_image')
                                                    ->label('Image de présentation')
                                                    ->image()
                                                    ->directory('about-images')
                                                    ->imageEditor()
                                                    ->hint(new \Illuminate\Support\HtmlString('Pour optimiser votre image: <a href="https://squoosh.app/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Squoosh</a>')),

                                                TextInput::make('hero_image_alt')
                                                    ->label('Texte alternatif de l\'image')
                                                    ->placeholder('Description pertinente de l\'image'),
                                            ])
                                            ->columnSpan(1),
                                    ]),
                            ]),

                        // Onglet 2: Informations personnelles
                        Tabs\Tab::make('Informations personnelles')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Coordonnées')
                                            ->schema([
                                                TextInput::make('address')
                                                    ->label('Adresse')
                                                    ->placeholder('88c rue de bas vernaz, 74240 GAILLARD'),

                                                TextInput::make('email')
                                                    ->label('Email')
                                                    ->email()
                                                    ->placeholder('lina-marie.michel@hotmail.fr'),

                                                TextInput::make('phone')
                                                    ->label('Téléphone')
                                                    ->tel()
                                                    ->placeholder('+33 6 05 27 66 22'),

                                                TextInput::make('driving_license')
                                                    ->label('Permis')
                                                    ->placeholder('Permis B, véhiculée'),
                                            ])
                                            ->columnSpan(1),

                                        Section::make('Informations générales')
                                            ->schema([
                                                TextInput::make('nationality')
                                                    ->label('Nationalité')
                                                    ->placeholder('Française'),

                                                TextInput::make('education_school')
                                                    ->label('École')
                                                    ->placeholder('ESUPCOM'),

                                                TextInput::make('education_degree')
                                                    ->label('Diplôme')
                                                    ->placeholder('Master'),

                                                TextInput::make('languages')
                                                    ->label('Langues')
                                                    ->placeholder('Français, Anglais (B2), Italien'),
                                            ])
                                            ->columnSpan(1),
                                    ]),
                            ]),

                        // Onglet 3: Compétences
                        Tabs\Tab::make('Compétences')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Graphisme & Web')
                                            ->schema([
                                                TextInput::make('skills_section1_title')
                                                    ->label('Titre de section')
                                                    ->required()
                                                    ->placeholder('Graphisme & Web'),

                                                Repeater::make('skills_graphism')
                                                    ->label('Compétences')
                                                    ->schema([
                                                        TextInput::make('name')
                                                            ->label('Nom de la compétence')
                                                            ->required()
                                                            ->placeholder('Suite Adobe'),

                                                        TextInput::make('percentage')
                                                            ->label('Pourcentage')
                                                            ->numeric()
                                                            ->minValue(0)
                                                            ->maxValue(100)
                                                            ->required()
                                                            ->placeholder('95'),
                                                    ])
                                                    ->defaultItems(0)
                                                    ->collapsible()
                                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                                            ])
                                            ->columnSpan(1),

                                        Section::make('Marketing & Outils')
                                            ->schema([
                                                TextInput::make('skills_section2_title')
                                                    ->label('Titre de section')
                                                    ->required()
                                                    ->placeholder('Marketing & Outils'),

                                                Repeater::make('skills_marketing')
                                                    ->label('Compétences')
                                                    ->schema([
                                                        TextInput::make('name')
                                                            ->label('Nom de la compétence')
                                                            ->required()
                                                            ->placeholder('Salesforce'),

                                                        TextInput::make('percentage')
                                                            ->label('Pourcentage')
                                                            ->numeric()
                                                            ->minValue(0)
                                                            ->maxValue(100)
                                                            ->required()
                                                            ->placeholder('90'),
                                                    ])
                                                    ->defaultItems(0)
                                                    ->collapsible()
                                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                                            ])
                                            ->columnSpan(1),
                                    ]),
                            ]),

                        // Onglet 4: Outils & Intérêts
                        Tabs\Tab::make('Outils & Intérêts')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Outils')
                                            ->schema([
                                                TextInput::make('tools_section_title')
                                                    ->label('Titre de section')
                                                    ->required()
                                                    ->placeholder('Outil'),

                                                TagsInput::make('tools_list')
                                                    ->label('Liste des outils')
                                                    ->placeholder('Tapez et appuyez sur Entrée pour ajouter')
                                                    ->helperText('Ajoutez chaque outil séparément'),
                                            ])
                                            ->columnSpan(1),

                                        Section::make('Centres d\'intérêt')
                                            ->schema([
                                                TextInput::make('interests_section_title')
                                                    ->label('Titre de section')
                                                    ->required()
                                                    ->placeholder('Centres d\'intérêt'),

                                                TagsInput::make('interests_list')
                                                    ->label('Liste des centres d\'intérêt')
                                                    ->placeholder('Tapez et appuyez sur Entrée pour ajouter')
                                                    ->helperText('Ajoutez chaque centre d\'intérêt séparément'),
                                            ])
                                            ->columnSpan(1),
                                    ]),
                            ]),

                        // Onglet 5: Parcours
                        Tabs\Tab::make('Parcours')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Formations')
                                            ->schema([
                                                TextInput::make('education_section_title')
                                                    ->label('Titre de section')
                                                    ->required()
                                                    ->placeholder('Formations'),

                                                Repeater::make('education_items')
                                                    ->label('Liste des formations')
                                                    ->schema([
                                                        TextInput::make('period')
                                                            ->label('Période')
                                                            ->required()
                                                            ->placeholder('2020 - 2022'),

                                                        TextInput::make('school')
                                                            ->label('École/Établissement')
                                                            ->required()
                                                            ->placeholder('ESUPCOM'),

                                                        TextInput::make('degree')
                                                            ->label('Diplôme/Formation')
                                                            ->required()
                                                            ->placeholder('Master Communication des entreprises'),
                                                    ])
                                                    ->defaultItems(0)
                                                    ->collapsible()
                                                    ->itemLabel(fn (array $state): ?string => $state['school'] ?? null),
                                            ])
                                            ->columnSpan(1),

                                        Section::make('Expériences')
                                            ->schema([
                                                TextInput::make('experience_section_title')
                                                    ->label('Titre de section')
                                                    ->required()
                                                    ->placeholder('Expériences'),

                                                Repeater::make('experience_items')
                                                    ->label('Liste des expériences')
                                                    ->schema([
                                                        TextInput::make('period')
                                                            ->label('Période')
                                                            ->required()
                                                            ->placeholder('2022 - Présent'),

                                                        TextInput::make('company')
                                                            ->label('Entreprise')
                                                            ->required()
                                                            ->placeholder('Pellenc ST'),

                                                        TextInput::make('position')
                                                            ->label('Poste')
                                                            ->required()
                                                            ->placeholder('Chargée Marketing'),
                                                    ])
                                                    ->defaultItems(0)
                                                    ->collapsible()
                                                    ->itemLabel(fn (array $state): ?string => $state['company'] ?? null),
                                            ])
                                            ->columnSpan(1),
                                    ]),
                            ]),

                        // Onglet 6: CV
                        Tabs\Tab::make('CV')
                            ->schema([
                                Section::make('Fichier CV')
                                    ->schema([
                                        FileUpload::make('cv_file')
                                            ->label('Fichier CV')
                                            ->directory('cv-files')
                                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'])
                                            ->hint(new \Illuminate\Support\HtmlString('Formats acceptés : PDF, JPG, PNG. <br>Pour optimiser vos fichiers: PDF → <a href="https://tinywow.com/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">TinyWOW</a> | Images → <a href="https://squoosh.app/" target="_blank" class="text-blue-600 hover:text-blue-800 underline">Squoosh</a>')),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_title')
                    ->label('Titre de la page')
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nom complet')
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
            'index' => Pages\ListAboutContents::route('/'),
            'create' => Pages\CreateAboutContent::route('/create'),
            'edit' => Pages\EditAboutContent::route('/{record}/edit'),
        ];
    }
}
