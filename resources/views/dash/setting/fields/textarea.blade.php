<div class="form-group  @if(isset($fields['row'])) {{ $field['col'] ?? 'col' }} @endif {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
    <textarea type="{{ $field['type'] }}"
           name="{{ $field['name'] }}" rows="4"
           class="form-control  {{ array_get( $field, 'class') }}"
           id="{{ $field['name'] }}"
           placeholder="{{ $field['label'] }}">{{ old($field['name'], \setting($field['name'])) }}</textarea>

    @if ($errors->has($field['name'])) <small class="help-block">{{ $errors->first($field['name']) }}</small> @endif
</div>
