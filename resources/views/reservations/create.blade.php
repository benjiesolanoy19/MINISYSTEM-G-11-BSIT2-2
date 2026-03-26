@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const timeInInput = document.querySelector('input[name="time_in"]');
  const timeOutInput = document.querySelector('input[name="time_out"]');
  
  if (timeInInput && timeOutInput) {
    timeInInput.addEventListener('change', function() {
      timeOutInput.min = this.value;
    });
    
    timeOutInput.addEventListener('change', function() {
      if (timeInInput.value && this.value <= timeInInput.value) {
        this.setCustomValidity('Time out must be after time in');
      } else {
        this.setCustomValidity('');
      }
    });
  }
});
</script>
@endsection

