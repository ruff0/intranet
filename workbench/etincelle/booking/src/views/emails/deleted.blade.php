@extends('emails.master')

@section('title')
    Annulation de réservation de salle
@stop

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                La réservation suivante vient d'être annulée
            </td>
        </tr>
        <tr>
            <td class="content-block">
                <table>
                    <tr>
                        <td width="30%">Utilisateur</td>
                        <td><strong>{{$user->fullname}}</strong></td>
                    </tr>
                    <tr>
                        <td width="30%">Salle</td>
                        <td><strong>{{$ressource->name}}</strong></td>
                    </tr>
                    <tr>
                        <td width="30%">Date</td>
                        <td>
                            <strong>
                                {{date('d/m/Y H:i', strtotime($booking_item->start_at))}}
                                ({{ durationToHuman($booking_item->duration) }})
                            </strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="content-block">
                Pour toute question ou suggestion, n'hésitez pas à
                <a href="mailto:{{$_ENV['mail_address']}}">nous contacter</a>.
            </td>
        </tr>
    </table>
@stop


