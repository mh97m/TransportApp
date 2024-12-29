import Button from '@/Components/Button';
import SearchSelect from '@/Components/SearchSelect';
import TextAreaInput from '@/Components/TextAreaInput';
import TextInput from '@/Components/TextInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Box from '@mui/material/Box';
import Slider from '@mui/material/Slider';
import { useForm } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';

export default function RegisterForm({ cities, cargoTypes, carTypes }) {
    const user = usePage().props.auth.user;

    // Use Inertia's useForm hook to manage form state and submission
    const { data, setData, post, processing, errors, reset } = useForm({
        mobile: user.mobile || '',
        carTypeId: '',
        cargoTypeId: '',
        originCityId: '',
        destinationCityId: '',
        weight: '',
        price: '',
        description: '',
        temperatureRange: [-5, 5],
    });

    const getOptionByValue = (options, value) => {
        return options.find(option => option.value === value) || null;
    };

    const handleChange = (e) => {
        if (e.target) {
            // Handle regular input changes
            const { name, value } = e.target;
            setData(name, value);
        } else if (Array.isArray(e)) {
            // Handle Slider changes
            setData('temperatureRange', e);
        } else {
            // Handle react-select changes
            const { name, value } = e;
            setData(name, value);
        }
    };

    const handleSelectChange = (name, selectedOption) => {
        setData(name, selectedOption ? selectedOption.value : '');
    };

    const handleSliderChange = (_, newValue) => {
        setData('temperatureRange', newValue);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('cargos.store')); // Use Inertia's post function to submit the form
    };

    return (
        <AuthenticatedLayout>
            <div className="row">
                <div className="col-12">
                    <div className="card-box">
                        <h3 className="mb-4">اعلام بار</h3>
                        <form onSubmit={handleSubmit}>
                            <div className="form-group row">
                                <TextInput
                                    lgLength="4"
                                    label="شماره موبایل"
                                    id="mobile"
                                    name="mobile"
                                    value={data.mobile}
                                    onChange={handleChange}
                                    error={errors.mobile}
                                />
                                <SearchSelect
                                    lgLength="4"
                                    label="نوع بار"
                                    id="cargoTypeId"
                                    name="cargoTypeId"
                                    options={cargoTypes}
                                    value={getOptionByValue(cargoTypes, data.cargoTypeId)}
                                    onChange={(selected) =>
                                        handleSelectChange('cargoTypeId', selected)
                                    }
                                    error={errors.cargoTypeId}
                                />
                                <SearchSelect
                                    lgLength="4"
                                    label="نوع وسیله"
                                    id="carTypeId"
                                    name="carTypeId"
                                    options={carTypes}
                                    value={getOptionByValue(carTypes, data.carTypeId)}
                                    onChange={(selected) =>
                                        handleSelectChange('carTypeId', selected)
                                    }
                                    error={errors.carTypeId}
                                />
                            </div>

                            <div className="form-group row">
                                <SearchSelect
                                    label="شهر مبدا"
                                    id="originCityId"
                                    name="originCityId"
                                    options={cities}
                                    value={getOptionByValue(cities, data.originCityId)}
                                    onChange={(selected) =>
                                        handleSelectChange('originCityId', selected)
                                    }
                                    error={errors.originCityId}
                                />
                                <SearchSelect
                                    label="شهر مقصد"
                                    id="destinationCityId"
                                    name="destinationCityId"
                                    options={cities}
                                    value={getOptionByValue(cities, data.destinationCityId)}
                                    onChange={(selected) =>
                                        handleSelectChange('destinationCityId', selected)
                                    }
                                    error={errors.destinationCityId}
                                />
                            </div>

                            <div className="form-group row">
                                <TextInput
                                    label="وزن (تن)"
                                    type="number"
                                    id="weight"
                                    name="weight"
                                    value={data.weight}
                                    onChange={handleChange}
                                    error={errors.weight}
                                />
                                <TextInput
                                    label="مبلغ"
                                    type="number"
                                    id="price"
                                    name="price"
                                    value={data.price}
                                    onChange={handleChange}
                                    error={errors.price}
                                />
                            </div>

                            <div className="form-group row">
                                <div className="form-group col-12">
                                    <label htmlFor="temperature">
                                        محدوده دمایی: {data.temperatureRange && data.temperatureRange[0] + " تا " + data.temperatureRange[1]}
                                    </label>
                                    <Box className="col-12">
                                        <Slider
                                            getAriaLabel={() => 'Temperature'}
                                            orientation="horizontal"
                                            getAriaValueText={(value) =>
                                                `${value}°C`
                                            }
                                            min={-25}
                                            max={25}
                                            value={data.temperatureRange}
                                            onChange={handleSliderChange}
                                            valueLabelDisplay="auto"
                                            marks={[
                                                {
                                                    value: -25,
                                                    label: '25°C-',
                                                },
                                                {
                                                    value: 25,
                                                    label: '25°C',
                                                },
                                            ]}
                                        />
                                    </Box>
                                </div>
                            </div>

                            <div className="form-group row">
                                <TextAreaInput
                                    label="توضیحات"
                                    id="description"
                                    name="description"
                                    value={data.description}
                                    onChange={handleChange}
                                    error={errors.description}
                                />
                            </div>

                            <Button label="ذخیره" type="submit" disabled={processing} />
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
