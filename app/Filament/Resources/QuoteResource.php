<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteResource\Pages;
use App\Filament\Resources\QuoteResource\RelationManagers;
use App\Models\Quote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteConfirmation;
use Filament\Notifications\Notification;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Personal Information Section
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter your first name'),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter your last name'),
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->placeholder('your@email.com'),
                        Forms\Components\TextInput::make('mobile_number')
                            ->label('Mobile Number')
                            ->required()
                            ->maxLength(15)
                            ->placeholder('Enter your mobile number'),
                    ])->columns(3),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('additional_info')
                            ->label('Additional Notes')
                            ->placeholder('Enter any additional information or special requirements')
                            ->nullable()
                            ->rows(3),
                    ])->columnSpan('full'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mobile_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('resend_confirmation')
                    ->label('Resend Confirmation')
                    ->visible(fn ($record) => !$record->is_confirmation)
                    ->action(function ($record, $data) {
                        try {
                            DB::beginTransaction();

                            // re-fetch fresh data
                            $quote = $record->fresh();

                            // Send confirmation email immediately
                            try {
                                Mail::to($quote->email)->send(new QuoteConfirmation($quote));
                            } catch(\Exception $e) {
                                // don't break the flow if mail fails; log and continue
                                report($e);
                                // rollback since we didn't complete the resend
                                DB::rollBack();
                                Notification::make()
                                    ->title('Failed to resend confirmation')
                                    ->danger()
                                    ->body($e->getMessage())
                                    ->send();
                                return;
                            }

                            // mark as confirmed
                            $record->update(['is_confirmation' => true]);

                            DB::commit();

                            Notification::make()
                                ->title('Confirmation resent')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            Notification::make()
                                ->title('Error')
                                ->danger()
                                ->body($e->getMessage())
                                ->send();
                        }
                    }),
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
            'index' => Pages\ListBusQuotes::route('/'),
            'create' => Pages\CreateBusQuote::route('/create'),
            'edit' => Pages\EditBusQuote::route('/{record}/edit'),
        ];
    }
}
