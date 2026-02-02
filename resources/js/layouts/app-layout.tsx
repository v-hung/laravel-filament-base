import type { FC, HTMLAttributes } from 'react';

export type AppLayoutProps = HTMLAttributes<HTMLDivElement>;

const AppLayout: FC<AppLayoutProps> = (props) => {
	const { className = '', children, ...rest } = props;

	return (
		<div {...rest} className={`${className}`}>
			{children}
		</div>
	);
};

export default AppLayout;
