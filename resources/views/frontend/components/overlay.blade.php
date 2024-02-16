<div id="bg-overlay" @class([
    'overlay | fixed top-0 left-0 h-full w-full z-[55] bg-black opacity-50', 
    'hidden' => is_null(session('input_error')) && is_null(session('step')),
])></div>