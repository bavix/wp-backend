<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{ $uuid }}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        {{--<textarea name="{{$name}}" rows="{{ $rows }}" id="{{ $id }}" placeholder="{{ $placeholder }}" {!! $attributes !!} >--}}
        {{--{{ old($column, $value) }}--}}
        {{--</textarea>--}}

        <div id="{{ $uuid }}" style="height: 480px"></div>

        <input type="hidden" id="{{$uuid . $id['lat']}}" name="{{$name['lat']}}"
               value="{{ old($column['lat'], $value['lat']) }}" {!! $attributes !!} />

        <input type="hidden" id="{{$uuid . $id['lng']}}" name="{{$name['lng']}}"
               value="{{ old($column['lng'], $value['lng']) }}" {!! $attributes !!} />

        @include('admin::form.help-block')

    </div>
</div>
