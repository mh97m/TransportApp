import { forwardRef, useImperativeHandle, useRef } from 'react';

export default forwardRef(function SelectInput(
    {
        label = '',
        size = 'lg',
        lgLength = 12,
        mdLength = 12,
        smLength = 12,
        id = 'inputId',
        name = 'inputName',
        disabled = false,
        error = null,
        options = [],
        children,
        ...props
    },
    ref,
) {
    const localRef = useRef(null);

    useImperativeHandle(ref, () => ({
        focus: () => localRef.current?.focus(),
    }));

    const selectClass = `form-control form-control-${size} text-left ${
        error ? 'is-invalid' : ''
    }`;

    return (
        <div
            className={`form-group col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            {children}
            <label className="font-weight-bold text-dark text-2">{label}</label>
            <select
                dir="rtl"
                id={id}
                name={name}
                className={selectClass}
                disabled={disabled}
                ref={localRef}
                {...props}
            >
                <option value="">انتخاب کنید</option>
                {options.length > 0 &&
                    options.map((option) => (
                        <option key={option.id} value={option.id}>
                            {option.title}
                        </option>
                    ))}
            </select>
            {error && (
                <span className="invalid-feedback" role="alert">
                    <strong>{error}</strong>
                </span>
            )}
        </div>
    );
});
