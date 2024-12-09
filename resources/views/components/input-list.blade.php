@props([
    'size' => 'lg',
    'lgLength' => '12',
    'mdLength' => '12',
    'smLength' => '12',
    'label' => '',
    'disabled' => false,
    'errors' => null,
    'options' => null,
    'uniqueId' => uniqid('input_'), // Generate a unique ID for each input
])

<div class="form-group col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }} position-relative">
    <label class="font-weight-bold text-dark text-2">{{ $label }}</label>
    <input
        {{ $attributes->merge([
            'id' => $uniqueId,
            'name' => 'input',
        ]) }}
        class="form-control form-control-{{ $size }} text-left @if ($errors) is-invalid @endif"
        @disabled($disabled)
        autocomplete="off"
        required
        oninput="filterDatalist(this, '{{ $uniqueId }}')"
    >
    <ul id="dropdownOptions_{{ $uniqueId }}" class="dropdown-menu w-100 shadow" style="max-height: 200px; overflow-y: auto; display: none; cursor: pointer;"></ul>
    @if ($errors)
        @foreach ($errors as $error)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $error }}</strong>
            </span>
        @endforeach
    @endif
</div>

<script>
    const options = @json($options); // Laravel passes PHP data to JS

    const filterDatalist = (input, uniqueId) => {
        const query = input.value.trim();
        const dropdownId = `dropdownOptions_${uniqueId}`;
        const dropdown = document.getElementById(dropdownId);

        dropdown.innerHTML = ''; // Clear previous options

        if (query.length >= 2) {
            const filteredOptions = options.filter(option =>
                option.name.toLowerCase().includes(query.toLowerCase())
            );

            if (filteredOptions.length > 0) {
                dropdown.style.display = 'block'; // Show dropdown
                filteredOptions.forEach(option => {
                    const li = document.createElement('li');
                    li.className = 'dropdown-item';
                    li.textContent = option.name;
                    li.setAttribute('data-id', option.id);
                    li.onclick = () => selectOption(input, option.name, dropdownId);
                    dropdown.appendChild(li);
                });
            } else {
                dropdown.style.display = 'none'; // Hide dropdown if no options
            }
        } else {
            dropdown.style.display = 'none'; // Hide dropdown for fewer characters
        }
    };

    const selectOption = (input, value, dropdownId) => {
        input.value = value; // Set the selected option
        document.getElementById(dropdownId).style.display = 'none'; // Hide dropdown
    };

    document.addEventListener('click', (e) => {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(e.target) && !e.target.matches('input')) {
                dropdown.style.display = 'none'; // Hide all dropdowns when clicking outside
            }
        });
    });
</script>
