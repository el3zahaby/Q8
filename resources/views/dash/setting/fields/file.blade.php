<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" />
<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
    @php($name = time() )
    @if(isset($field['data']) and $field['data'] == 'json' and (is_array(setting($field['name'])) or is_array($field['value']) )  )
        @if(setting($field['name']) != null || isset($field['value']))
            @php($arr = (!empty(setting($field['name']))? setting($field['name']): $field['value']))
{{--            @dd($arr)--}}
            @foreach($arr as $img)
                <a  class="{{$field['name']}}_remove" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Remove this item">
                    <img  src="{{ $img }}" style="width: 90px;">
                </a>
            @endforeach
            @push('js')
                <script>


                    $(document).ready(function () {
                        $("img")
                            .on('load', function() { console.log("image loaded correctly"); })
                            .on('error', function() {
                                var sarr = $('input[name="' + $('div.{{$field['name']}}').data('name') + '"]').val().split(",");
                                var found = sarr.indexOf($(this).attr('src'));
                                delete sarr[found];
                                this.remove();
                                var filtered = sarr.filter(function (el) {
                                    return el;
                                });
                                $('input[name="' + $('div.{{$field['name']}}').data('name') + '"]').val(filtered);
                            })
                            .attr("src", $(this).attr("src"));
                    });
                    $('.{{$field['name']}}_remove').click(function () {
                        sarr = $('input[name="' + $('div.{{$field['name']}}').data('name') + '"]').val().split(",");
                        var found = sarr.indexOf($(this).find('img').attr('src'));
                        delete sarr[found];
                        $(this).tooltip('hide').remove();
                        var filtered = sarr.filter(function (el) {
                            return el;
                        });
                        $('input[name="' + $('div.{{$field['name']}}').data('name') + '"]').val(filtered);
                        console.log(filtered);
                    });
                </script>
            @endpush
        @endif
            <div class="dropzone text-center {{ array_get( $field, 'class') }}"
                 data-name="{{ $field['name'] }}" data-filename="{{ $name }}">
            </div>
            <input type="hidden"
                   name="{{ $field['name'] }}"
                   value="{{ old(json_encode($field['value']),  implode(',',$arr)) }}"
                   class="form-control {{ array_get( $field, 'class') }}"
                   id="{{ $field['name'] }}"
                   placeholder="{{ $field['label'] }}">
    @else
        <div class="dropzone text-center {{ array_get( $field, 'class') }}" data-name="{{ $field['name'] }}" data-filename="{{ $name }}">
            @if(setting($field['name']) != null || isset($field['value']))
                <img src="{{setting($field['name']) ?? $field['value']}}" onerror="this.remove()" alt="{{setting($field['name'])}}"
                 style=" width: 90px; background: #eee; padding: 9px; border-radius: 6px; float: left; opacity: .5;">
            @endif
        </div>
        <input type=""
               name="{{ $field['name'] }}"
               value="{{ old($field['name'], \setting($field['name'])) ?? @$field['value'] }}"
               class="form-control {{ array_get( $field, 'class') }}"
               id="{{ $field['name'] }}"
               placeholder="{{ $field['label'] }}">
    @endif
    @if ($errors->has($field['name'])) <small class="help-block">{{ $errors->first($field['name']) }}</small> @endif
</div>
