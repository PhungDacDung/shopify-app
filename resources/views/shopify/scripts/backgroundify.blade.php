@if(isset($background))
    @if($background["color"])
        document.body.style.backgroundColor=`{{ $background["color"] }}`;
    @endif
    @if($background["backgroundImage"])
        document.body.style.backgroundImage=`url("{{ $background["backgroundImage"] }}")`;
        document.body.style.backgroundSize=`{{ $background["backgroundSize"] ?? 'cover' }}`;
        document.body.style.backgroundRepeat=`{{ $background["backgroundRepeat"] ?? "no-repeat" }}`;
    @endif
@endif
