import { useEffect, useRef, useState } from 'react';

export default function DatalistInput({
    size = 'lg',
    lgLength = 12,
    mdLength = 12,
    smLength = 12,
    label = '',
    disabled = false,
    error = null,
    options = [],
    name = 'input',
    uniqueId = `input_${Math.random().toString(36).substr(2, 9)}`,
    ...props
}) {
    const [query, setQuery] = useState('');
    const [filteredOptions, setFilteredOptions] = useState([]);
    const [selectedOption, setSelectedOption] = useState(null);
    const [showDropdown, setShowDropdown] = useState(false);

    const displayRef = useRef(null);
    const hiddenRef = useRef(null);
    const dropdownRef = useRef(null);

    useEffect(() => {
        if (query.length >= 2) {
            const filtered = options.filter((option) =>
                option.name.toLowerCase().includes(query.toLowerCase()),
            );
            setFilteredOptions(filtered);
            setShowDropdown(filtered.length > 0);
        } else {
            setShowDropdown(false);
        }
    }, [query, options]);

    const selectOption = (option) => {
        setQuery(option.name);
        setSelectedOption(option.id);
        setShowDropdown(false);
    };

    const handleOutsideClick = (e) => {
        if (
            dropdownRef.current &&
            !dropdownRef.current.contains(e.target) &&
            !displayRef.current.contains(e.target)
        ) {
            setShowDropdown(false);
        }
    };

    useEffect(() => {
        document.addEventListener('click', handleOutsideClick);
        return () => document.removeEventListener('click', handleOutsideClick);
    }, []);

    return (
        <div
            className={`form-group col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength} position-relative`}
        >
            <label className="font-weight-bold text-dark text-2">{label}</label>
            {/* Visible input for display */}
            <input
                type="text"
                id={`display_${uniqueId}`}
                className={`form-control form-control-${size} text-left ${error ? 'is-invalid' : ''}`}
                value={query}
                onChange={(e) => setQuery(e.target.value)}
                autoComplete="off"
                disabled={disabled}
                ref={displayRef}
                {...props}
            />

            {/* Hidden input for storing the ID */}
            <input
                type="text"
                name={name}
                value={selectedOption || ''}
                style={{ display: 'none' }}
                ref={hiddenRef}
            />

            {/* Dropdown options */}
            {showDropdown && (
                <ul
                    id={`dropdownOptions_${uniqueId}`}
                    className="dropdown-menu w-100 shadow"
                    style={{
                        maxHeight: '200px',
                        overflowY: 'auto',
                        cursor: 'pointer',
                    }}
                    ref={dropdownRef}
                >
                    {filteredOptions.map((option) => (
                        <li
                            key={option.id}
                            className="dropdown-item"
                            onClick={() => selectOption(option)}
                        >
                            {option.name}
                        </li>
                    ))}
                </ul>
            )}

            {/* Error handling */}
            {error && (
                <span className="invalid-feedback" role="alert">
                    <strong>{error}</strong>
                </span>
            )}
        </div>
    );
}
