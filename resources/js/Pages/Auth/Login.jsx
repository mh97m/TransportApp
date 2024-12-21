import Button from '@/Components/Button';
import CheckboxInput from '@/Components/CheckboxInput';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        mobile: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8 col-lg-6 col-xl-5">
                        <div className="card mb-0">
                            <div className="card-body p-4">
                                <div className="account-box">
                                    <div className="account-logo-box">
                                        <div className="text-center">
                                            <a href="index.html">
                                                <img
                                                    src="/assets/images/logo-dark.png"
                                                    alt=""
                                                    height="30"
                                                />
                                            </a>
                                        </div>
                                        <h5 className="text-uppercase mb-1 mt-4">
                                            ورود
                                        </h5>
                                        {/* <p className="mb-0">وارد حساب خود شوید</p> */}
                                    </div>

                                    <div className="account-content mt-4">
                                        <form
                                            className="form-horizontal"
                                            onSubmit={submit}
                                        >
                                            <div className="form-group row">
                                                <TextInput
                                                    label="شماره موبایل"
                                                    id="dataMobile"
                                                    name="mobile"
                                                    autoComplete="username"
                                                    isFocused={true}
                                                    value={data.mobile}
                                                    error={errors.email}
                                                    onChange={(e) =>
                                                        setData(
                                                            'email',
                                                            e.target.value,
                                                        )
                                                    }
                                                />
                                            </div>

                                            <div className="form-group row">
                                                <TextInput
                                                    label="رمز عبور"
                                                    type="password"
                                                    id="dataPassword"
                                                    name="password"
                                                    autoComplete="current-password"
                                                    value={data.password}
                                                    error={errors.password}
                                                    onChange={(e) =>
                                                        setData(
                                                            'password',
                                                            e.target.value,
                                                        )
                                                    }
                                                >
                                                    <a
                                                        className="float-right"
                                                        href={route(
                                                            'password.request',
                                                        )}
                                                    >
                                                        رمز عبور خود را فراموش
                                                        کردید؟
                                                    </a>
                                                </TextInput>
                                            </div>

                                            <div className="form-group row">
                                                <CheckboxInput
                                                    label="مرا به خاطر بسپار"
                                                    id="dataRemember"
                                                    name="remember"
                                                    checked={data.remember}
                                                    onChange={(e) =>
                                                        setData(
                                                            'remember',
                                                            e.target.checked,
                                                        )
                                                    }
                                                />
                                            </div>

                                            <div className="form-group row mt-2 text-center">
                                                <Button
                                                    label="ورود"
                                                    type="submit"
                                                    disabled={processing}
                                                />
                                            </div>
                                        </form>

                                        <div className="row mt-4 pt-2">
                                            <div className="col-sm-12 text-center">
                                                <p className="text-muted mb-0">
                                                    حساب کاربری ندارید؟
                                                    <a
                                                        href="{{ route('register') }}"
                                                        className="text-dark ml-1"
                                                    >
                                                        <b>ثبت نام</b>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </GuestLayout>
    );
}
