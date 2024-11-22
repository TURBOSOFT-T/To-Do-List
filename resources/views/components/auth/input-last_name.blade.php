@props(['last_name' => ''])

<div data-mdb-input-init class="form-outline">
  <label for="last_name">@lang('Last name')</label>
  <input

  id="last_name"
    {{--   class="h-full-width" --}}
    class="form-control"
      type="text"
      name="last_name"
      placeholder="@lang('Your last name')"
      value="{{ old('last_name', $last_name) }}"
      required
      autofocus>
</div>
