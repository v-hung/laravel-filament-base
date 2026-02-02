import { usePage } from '@inertiajs/react';

export default function FlashListener() {
	const { flash } = usePage();

	return (
		<>{flash.toast && <div className="toast">{flash.toast.message}</div>}</>
	);
}
