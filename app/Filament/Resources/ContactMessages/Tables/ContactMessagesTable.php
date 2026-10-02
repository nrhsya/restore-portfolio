<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Mail\ContactMessageReply;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Sender')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('subject')
                    ->placeholder('No subject')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'read' => 'info',
                        'replied' => 'success',
                        'archived' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'replied' => 'Replied',
                        'archived' => 'Archived',
                    ]),
            ])
            ->recordActions([
                Action::make('reply')
                    ->label('Reply')
                    ->fillForm(fn (ContactMessage $record): array => [
                            'reply_to' => $record->email,
                            'reply_subject' => $record->subject
                                ? 'Re: ' . $record->subject
                                : 'Re: Your message',
                        ])
                    ->schema([
                        Grid::make()
                            ->columns([
                                'sm' => 3,
                                'lg' => 3,
                            ])
                            ->schema([
                                Section::make('Client Details')
                                    ->schema([
                                        Fieldset::make('Contact Details')
                                            ->dense()
                                            ->schema([
                                                TextEntry::make('name')
                                                    ->label('Name')
                                                    ->copyable()
                                                    ->copyMessage('Copied!')
                                                    ->copyMessageDuration(1500),
                                                TextEntry::make('email')
                                                    ->label('Email address')
                                                    ->copyable()
                                                    ->copyMessage('Copied!')
                                                    ->copyMessageDuration(1500),
                                            ])
                                            ->columnSpanFull(),
                                        Fieldset::make('Status')
                                            ->dense()
                                            ->schema([
                                                TextEntry::make('status')
                                                    ->label('Status')
                                                    ->badge(),
                                                TextEntry::make('created_at')
                                                    ->label('Sent at')
                                                    ->badge(),
                                            ])
                                            ->columnSpanFull(),
                                        Fieldset::make('Message')
                                            ->dense()
                                            ->schema([
                                                TextEntry::make('subject')
                                                    ->label('Subject')
                                                    ->badge(),
                                                TextEntry::make('message')
                                                    ->label('Message'),
                                            ])
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull()
                                    ->collapsible(),
                                Section::make('Email Details')
                                    ->schema([
                                        TextInput::make('reply_to')
                                            ->label('To')
                                            ->email()
                                            ->required()
                                            ->readOnly()
                                            ->hint('This email will receive your reply.'),

                                        TextInput::make('reply_subject')
                                            ->label('Subject')
                                            ->required()
                                            ->maxLength(255),

                                        RichEditor::make('reply_message')
                                            ->label('Message')
                                            ->required()
                                            ->columnSpanFull()
                                            ->hint('Client will receive this message in their email inbox.'),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->icon('heroicon-o-chat-bubble-oval-left')
                    ->iconButton()
                    ->action(function (array $data, ContactMessage $record): void {
                        Mail::to($record->email)->send(
                            new ContactMessageReply(
                                contactMessage: $record,
                                replySubject: $data['reply_subject'],
                                replyMessage: $data['reply_message'],
                            )
                        );

                        $record->update([
                            'status' => ContactMessage::STATUS_REPLIED,
                            'read_at' => $record->read_at ?? now(),
                            'replied_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Reply sent successfully!')
                            ->success()
                            ->send();
                    }),
                    // ->action(function (array $data, ContactMessage $record): void {
                    //     dd($data);
                    //     // send email to the contact message sender
                    //     // $record->email = $data['email'];
                    //     // $record->name = $data['name'];
                    //     // $record->position = $data['position'];

                    //     // update the reply at in contactmessage
                    //     $record->replied_at = now();
                    //     $record->save();
                    // }),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
