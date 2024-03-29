<div class="table-responsive">
    <table class="table" id="rounds-table">
        <thead>
            <tr>
                <th>@lang('models/rounds.fields.enabled')</th>
        <th>@lang('models/rounds.fields.name')</th>
        <th>@lang('models/rounds.fields.date_time_limit')</th>
        <th>@lang('models/rounds.fields.league_id')</th>
        <th>@lang('models/rounds.fields.tournament_id')</th>
                <th  >@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rounds as $round)
            <tr>
            <td>
                {!! Form::checkbox('enabled', 1, $round->enabled,  ['number'=>$round->id,'data-toggle' => 'toggle','data-on'=>__('crud.yes'),'data-off'=>__('crud.no'), 'data-size'=>'mini','data-onstyle'=>'success', 'data-offstyle'=>'danger']) !!}
            </td>
            <td>{{ $round->name }}</td>
            <td>{{ $round->date_time_limit }}</td>
            <td> {{ $leagueItems[$round->league_id] ?? 'Disabled' }}</td>
            <td> {{  $tournamentItems[$round->tournament_id] ?? 'Disabled' }}</td>
                <td>
                    {!! Form::open(['route' => ['rounds.destroy', $round->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('rounds.show', [$round->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('rounds.edit', [$round->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
