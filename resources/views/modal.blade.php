<div class="remodal" data-remodal-id="{{$Modal->modalName}}"
   data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
   <button data-remodal-action="close" class="remodal-close"></button>
   <div class="remodal-form">
      <p>{{$Modal->modalHeader}}</p>
      @foreach ($Modal->modalFields as $field) 
      @if (!isset($field['visible']) || $field['visible']==true)
      @if ($field['type']=="select")
      <select  name="{{$field['name']}}" >
         @foreach ($field['values'] as $option) 
         <option value="{{$option['value']}}">{{$option['text']}}</option>
         @endforeach
      </select>
      @else
      <input type="{{$field['type']}}" placeholder="{{$field['placeholder']}}" name="{{$field['name']}}" @if (isset($field['value'])) value="{{$field['value']}}" @endif>
      @endif
      @else
      <input type="{{$field['type']}}" style="display: none;" placeholder="{{$field['placeholder']}}" name="{{$field['name']}}" @if (isset($field['value'])) value="{{$field['value']}}" @endif>
      @endif
      @endforeach
   </div>
   <button data-remodal-action="confirm" class="remodal-confirm" id="{{$Modal->btnId}}">اضافه کردن</button>
   <button data-remodal-action="cancel" class="remodal-cancel">انصراف</button>
</div>