<x-app-layout>
@section('title', '404')

<h3 class="text-center mt-10">404 - {{ __('The requested page was not found.') }}</h3>

@include('errors.messages')

</x-app-layout>

