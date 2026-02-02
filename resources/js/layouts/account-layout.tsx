import type {} from '@/types';

export type AppLayoutProps = React.HTMLAttributes<HTMLDivElement>;

const AccountLayout: React.FC<AppLayoutProps> = ({ children }) => {
	return (
		<div className="flex min-h-screen flex-col">
			{/* Header */}
			<header className="border-b">
				<div className="container mx-auto px-4">
					<div className="flex h-16 items-center justify-between">
						<div className="text-xl font-bold">
							<a href="/">Your Shop</a>
						</div>
						<div>{/* Add user menu here */}</div>
					</div>
				</div>
			</header>

			{/* Main Content with Sidebar */}
			<main className="flex-1">
				<div className="container mx-auto px-4 py-8">
					<div className="grid grid-cols-1 gap-8 lg:grid-cols-12">
						{/* Sidebar Navigation - Customize links */}
						<aside className="lg:col-span-3">
							<nav className="space-y-1">
								<a
									href="/settings/profile"
									className="block rounded px-3 py-2 hover:bg-gray-100"
								>
									Profile
								</a>
								<a
									href="/settings/password"
									className="block rounded px-3 py-2 hover:bg-gray-100"
								>
									Password
								</a>
								<a
									href="/settings/two-factor"
									className="block rounded px-3 py-2 hover:bg-gray-100"
								>
									Two-Factor Auth
								</a>
								<a
									href="/settings/appearance"
									className="block rounded px-3 py-2 hover:bg-gray-100"
								>
									Appearance
								</a>
							</nav>
						</aside>

						{/* Main Content Area */}
						<div className="lg:col-span-9">{children}</div>
					</div>
				</div>
			</main>
		</div>
	);
};

export default AccountLayout;
