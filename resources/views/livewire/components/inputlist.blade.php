<?php

use Livewire\Volt\Component;

new class extends Component
{
    public $options = [];
    public $selectedValue = '';
    public $selectedId = '';
    public $errors = null;

    protected $listeners = ['updateSelectedOption'];

    public function mount($options)
    {
        $this->options = $options;
    }

    public function updatedSelectedValue($value)
    {
        $this->selectedValue = $value;
        $this->emit('selectedValueChanged', $value);
    }

    public function updateSelectedOption($value, $id)
    {
        $this->selectedValue = $value;
        $this->selectedId = $id;
    }
}; ?>

<div class="form-group col-lg-{{ $lgLength }} col-md-{{ $mdLength }} col-sm-{{ $smLength }} position-relative">
    <label class="font-weight-bold text-dark text-2">{{ $label }}</label>

    <!-- Visible input for display -->
    <input
        type="text"
        wire:model="selectedValue"
        id="display_{{ $uniqueId }}"
        class="form-control form-control-{{ $size }} text-left @if ($errors) is-invalid @endif"
        autocomplete="off"
        @disabled($disabled)
        oninput="filterDatalist(this, '{{ $uniqueId }}')"
    >

    <!-- Hidden input for storing the ID -->
    <input
        type="text"
        style="display: none;"
        wire:model="selectedId"
        id="hidden_{{ $uniqueId }}"
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
                    li.onclick = () => selectOption(input, option.name, option.id, uniqueId);
                    dropdown.appendChild(li);
                });
            } else {
                dropdown.style.display = 'none'; // Hide dropdown if no options
            }
        } else {
            dropdown.style.display = 'none'; // Hide dropdown for fewer characters
        }
    };

    const selectOption = (input, value, id, uniqueId) => {
        const displayInput = document.getElementById(`display_${uniqueId}`);
        const hiddenInput = document.getElementById(`hidden_${uniqueId}`);
        
        displayInput.value = value; // Set the visible input's value
        hiddenInput.value = id; // Set the hidden input's value
        
        // Trigger the Livewire update
        @this.call('updateSelectedOption', value, id);

        const dropdown = document.getElementById(`dropdownOptions_${uniqueId}`);
        dropdown.style.display = 'none'; // Hide dropdown
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
