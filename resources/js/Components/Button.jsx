export default function Button({
    id = 'inputId',
    color = 'primary',
    label = '',
    lgLength = 12,
    mdLength = 12,
    smLength = 12,
    size = 'lg',
    className = '',
    children,
    ...props
}) {
    const buttonClasses = `btn btn-${size} btn-block btn-${color} waves-effect waves-light ffiy ${className}`;

    return (
        <div
            className={`col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            <button
                id={id}
                type="submit"
                className={buttonClasses}
                {...props}
            >
                {label || children}
            </button>
        </div>
    );
};
