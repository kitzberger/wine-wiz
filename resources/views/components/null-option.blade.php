@props(['count'])

@switch($count)
    @case(0)<option>- empty -</option>@break
    @case(1)<!--nothing-->@break
    @default<option></option>
@endswitch
