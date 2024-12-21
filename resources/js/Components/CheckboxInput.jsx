export default function CheckboxInput({
    id = 'inputId',
    label = '',
    lgLength = '12',
    mdLength = '12',
    smLength = '12',
    disabled = false,
    ...props
}) {
    return (
        <div
            className={`col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            <div className="checkbox checkbox-success">
                <input
                    type="checkbox"
                    id={id}
                    name="input"
                    disabled={disabled}
                    {...props}
                />
                <label htmlFor={id}>{label}</label>
            </div>
        </div>
    );
};
