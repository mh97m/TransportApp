import { useState } from 'react';

export default function CargoCart({
    cargo,
    isAnimate = false,
    footer = null,
    children,
}) {
    const [isHovered, setisHovered] = useState(isAnimate);
    return (
        <div
            className="col-lg-4 col-md-6 col-sm-12 mb-3"
            onMouseEnter={() => setisHovered(true)}
            onMouseLeave={() => setisHovered(false)}
        >
            <div
                className="card"
                style={{
                    borderRadius: '10px',
                    boxShadow: '0px 0px 7px rgba(0, 0, 0, 0.342)',
                }}
            >
                <div className="card-body text-center">
                    <div className="d-flex flex-column align-items-center position-relative mb-3">
                        <div className="text-center">
                            <div
                                className="small text-muted text-3 my-1"
                                style={{ fontSize: '16px' }}
                            >
                                {cargo.distance} کیلومتر
                            </div>
                        </div>

                        <div
                            className="w-100 position-relative mb-4"
                            style={{
                                position: 'relative',
                            }}
                        >
                            <div className="position-absolute w-100 d-flex align-items-center justify-content-center">
                                <i
                                    className="fas fa-map-marker-alt text-danger mb-1 mr-1"
                                    style={{ fontSize: '32px' }}
                                ></i>

                                <svg
                                    height="50"
                                    viewBox="0 0 225 50"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    style={{
                                        borderRadius: '30px',
                                        margin: '0 5px',
                                    }}
                                >
                                    {/* Road background */}
                                    <rect
                                        x="0"
                                        y="15"
                                        width="400"
                                        height="20"
                                        fill="#4e4e4ec9"
                                    />

                                    {/* Dashed lines */}
                                    <line
                                        x1="0"
                                        y1="25"
                                        x2="20"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="30"
                                        y1="25"
                                        x2="50"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="60"
                                        y1="25"
                                        x2="80"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="90"
                                        y1="25"
                                        x2="110"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="120"
                                        y1="25"
                                        x2="140"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="150"
                                        y1="25"
                                        x2="170"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="180"
                                        y1="25"
                                        x2="200"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="210"
                                        y1="25"
                                        x2="230"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="240"
                                        y1="25"
                                        x2="260"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="270"
                                        y1="25"
                                        x2="290"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="300"
                                        y1="25"
                                        x2="320"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="330"
                                        y1="25"
                                        x2="350"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />
                                    <line
                                        x1="360"
                                        y1="25"
                                        x2="380"
                                        y2="25"
                                        stroke="white"
                                        strokeWidth="2"
                                    />

                                    {/* Arrow */}
                                    <path
                                        d="M 10 22 L 10 28 L 0 25 Z"
                                        fill="white"
                                    />
                                </svg>

                                {/* Car positioned in the middle */}
                                <div
                                    style={{
                                        animation: isHovered
                                            ? 'moveCarHover 2s infinite alternate'
                                            : 'none',
                                        position: 'absolute',
                                        top: '0px', // Align the car vertically in the middle of the road
                                        left: '50%', // Center horizontally
                                        transform: 'translateX(-50%)',
                                    }}
                                >
                                    <i
                                        className="fas fa-car-side"
                                        style={{
                                            fontSize: '24px',
                                            transform: 'scaleX(-1)',
                                            color: 'black',
                                        }}
                                    ></i>
                                </div>

                                <i
                                    className="fas fa-map-pin text-success mb-1 ml-1 mr-1"
                                    style={{ fontSize: '32px' }}
                                ></i>
                            </div>

                            <style>{`
                                @keyframes moveCarHover {
                                    0% {
                                        transform: translate(-50%, 0);
                                    }
                                    100% {
                                        transform: translate(-330%, 0);
                                    }
                                }
                            `}</style>
                        </div>

                        <div className="row col-12 d-flex justify-content-between w-100 h4">
                            <div className="col-4 text-center">
                                <h4 className="font-weight-bold mb-1">
                                    {cargo.origin_province?.title}
                                </h4>
                                <small
                                    className="text-muted"
                                    style={{ fontSize: '14px' }}
                                >
                                    {cargo.origin_city?.title}
                                </small>
                            </div>

                            <div className="col-4 text-center">
                                <h4 className="font-weight-bold mb-1">
                                    {cargo.destination_province?.title}
                                </h4>
                                <small
                                    className="text-muted"
                                    style={{ fontSize: '14px' }}
                                >
                                    {cargo.destination_city?.title}
                                </small>
                            </div>
                        </div>
                    </div>

                    <div className="text-muted mt-3">
                        <div className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                            {/* <i
                                className="fas fa-weight-hanging text-secondary mb-1 mr-2"
                                style={{ fontSize: '24px' }}
                            ></i> */}
                            <div
                                style={{
                                    fontSize: '30px',
                                    transform: 'scaleX(-1)',
                                    marginLeft: '10px',
                                }}
                            >
                                📦
                            </div>
                            {cargo.weight} تن
                        </div>
                        <div className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                            {/* <i
                                className="fas fa-car-side text-secondary mb-1 mr-2"
                                style={{
                                    fontSize: '24px',
                                    transform: 'scaleX(-1)',
                                }}
                            ></i> */}
                            <div
                                style={{
                                    fontSize: '30px',
                                    // transform: 'scaleX(-1)',
                                    marginLeft: '10px',
                                }}
                            >
                                🚛
                            </div>
                            {cargo.car_type?.title} یخچالی
                        </div>
                        <div className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                            {/* <i
                                className="far fa-comment-alt text-secondary mb-1 mr-2"
                                style={{ fontSize: '24px' }}
                            ></i> */}
                            <div
                                style={{
                                    fontSize: '30px',
                                    // transform: 'scaleX(-1)',
                                    marginLeft: '10px',
                                }}
                            >
                                ❄️
                            </div>
                            {cargo.temperature_min} تا {cargo.temperature_max}
                        </div>
                        <div className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                            {/* <i
                                className="far fa-comment-alt text-secondary mb-1 mr-2"
                                style={{ fontSize: '24px' }}
                            ></i> */}
                            <div
                                style={{
                                    fontSize: '30px',
                                    // transform: 'scaleX(-1)',
                                    marginLeft: '10px',
                                }}
                            >
                                📋
                            </div>
                            {cargo.description.short}
                        </div>
                    </div>

                    <div className="row mt-4 text-center">
                        <div className="col-12">
                            <h4
                                className="text-black"
                                style={{ fontSize: '22px' }}
                            >
                                {/* <i className="fas fa-coins text-success fa-lg h4"></i>{' '} */}
                                💵 {cargo.price.toLocaleString()} تومان
                            </h4>
                        </div>
                    </div>

                    {children}
                </div>
                {footer && (footer)}
            </div>
        </div>
    );
}
