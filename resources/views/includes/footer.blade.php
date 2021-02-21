<footer>
	<div class="container">
		<p class="text-center">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) Loaded in: {{ (microtime(true) - LARAVEL_START) }}</p>
	</div>
</footer>

<!-- JavaScript -->
<script src="{{ URL::asset('js/moment.min.js')}}"></script>
<script src="{{ URL::asset('js/app.js')}}"></script>
