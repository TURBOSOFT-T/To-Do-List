@props(['first_name' => ''])

<div class="field">
  <label class="form-label" for="first_name">@lang('Name and last name')</label>
  <input

  id="first_name"
     {{--  class="h-full-width" --}}
     class="form-control"
      type="text"
      name="first_name"

      value="{{ old('first_name', $first_name) }}"
      required
      autofocus>
</div>
