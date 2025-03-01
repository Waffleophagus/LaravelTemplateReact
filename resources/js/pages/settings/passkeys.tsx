import { useForm, router, Head } from '@inertiajs/react';
import { Trash2 } from 'lucide-react';
import { FormEventHandler } from 'react';

import InputError from '@/components/input-error';
import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import SettingsLayout from '@/layouts/settings/layout';
import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import { Transition } from '@headlessui/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Passkey settings',
        href: '/settings/passkeys',
    },
];

interface Passkey {
    id: number;
    name: string;
    created_at: string;
}

export default function PasskeyManager({ passkeys = [] }: { passkeys: Passkey[] }) {
    const { data, setData, errors, post, reset, processing, recentlySuccessful } =
        useForm({
            name: '',
        });

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('passkey.store'), {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    };

    const handleDelete = (id: number) => {
        if (confirm('Are you sure you want to remove this passkey?')) {
            router.delete(route('passkey.delete', id));
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Profile settings" />
            <SettingsLayout>
                <div className="space-y-6">
                    <HeadingSmall
                        title="Manage Passkeys"
                        description="Passkeys allow for more secure authentication on supported devices"
                    />

                    {/* Create passkey form */}
                    <form onSubmit={handleSubmit} className="space-y-6">
                        <div className="grid gap-2">
                            <Label htmlFor="passkey_name">Passkey Name</Label>
                            <Input
                                id="passkey_name"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                className="mt-1 block w-full"
                                placeholder="My Passkey"
                            />
                            <InputError message={errors.name} />
                        </div>

                        <div className="flex items-center gap-4">
                            <Button type="submit" disabled={processing}>
                                Create Passkey
                            </Button>

                            <Transition
                                show={recentlySuccessful}
                                enter="transition ease-in-out"
                                enterFrom="opacity-0"
                                leave="transition ease-in-out"
                                leaveTo="opacity-0"
                            >
                                <p className="text-sm text-neutral-600">Created</p>
                            </Transition>
                        </div>
                    </form>

                    {/* Passkeys list */}
                    <div className="space-y-4">
                        <HeadingSmall
                            title="Your Passkeys"
                            description="Manage your existing passkeys"
                        />

                        {passkeys.length === 0 ? (
                            <p className="text-sm text-neutral-600">
                                No passkeys created yet.
                            </p>
                        ) : (
                            <ul className="divide-y divide-neutral-100 rounded-md border border-neutral-200">
                                {passkeys.map((passkey) => (
                                    <li
                                        key={passkey.id}
                                        className="flex items-center justify-between px-4 py-3"
                                    >
                                        <div>
                                            <p className="font-medium">{passkey.name}</p>
                                            <p className="text-sm text-neutral-500">
                                                {passkey.created_at}
                                            </p>
                                        </div>

                                        <Button
                                            variant="destructive"
                                            size="sm"
                                            onClick={() => handleDelete(passkey.id)}
                                        >
                                            <Trash2 className="mr-1 h-4 w-4" />
                                            Remove
                                        </Button>
                                    </li>
                                ))}
                            </ul>
                        )}
                    </div>
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}
