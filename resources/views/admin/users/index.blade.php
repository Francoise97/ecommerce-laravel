@extends('admin.layout')

@section('title', 'Gestion des clients')

@section('content')
<div class="card" style="padding: 0; overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa; text-align: left;">
                <th style="padding: 15px;">Client</th>
                <th style="padding: 15px;">Email</th>
                <th style="padding: 15px;">Inscrit le</th>
                <th style="padding: 15px;">Commandes</th>
                <th style="padding: 15px; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                        <span class="material-symbols-outlined" style="color: #d35400;">account_circle</span>
                        {{ $user->name }}
                    </td>
                    <td style="padding: 12px; color: #555;">{{ $user->email }}</td>
                    <td style="padding: 12px; font-size: 13px; color: #888;">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td style="padding: 12px;">
                        <span style="background: #e7f3ff; color: #004085; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                            {{ $user->orders_count }} commande(s)
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: right;">
                        <a href="{{ route('admin.users.orders', $user->id) }}" class="btn btn-primary btn-sm">
                            <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span> Voir ses commandes
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 40px; text-align: center; color: #888;">
                        <span class="material-symbols-outlined" style="font-size: 40px; color: #ccc; margin-bottom: 10px;">group_off</span><br>
                        Aucun client inscrit pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
