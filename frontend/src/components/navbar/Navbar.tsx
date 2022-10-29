import React, { FC } from 'react';
import { Col, Layout, Menu, Row } from 'antd';
import { useNavigate } from 'react-router-dom';
import { RouteNames } from '../../router';

const Navbar: FC = () => {
	const navigate = useNavigate();

	return (
		<Layout.Header color={'red !important'}>
			<Row justify={'space-between'}>
				<Col span={12} offset={7}>
					<Menu selectable={false} theme={'dark'} mode={'horizontal'}>
						<Menu.Item
							key={1}
							onClick={() => navigate(RouteNames.MAIN)}
						>
							Главная
						</Menu.Item>
						<Menu.Item key={2}>Сборка</Menu.Item>
						<Menu.Item key={3}>О нас</Menu.Item>
						<Menu.Item key={4}>FAQ</Menu.Item>
					</Menu>
				</Col>
				<Col span={5}>
					<Menu selectable={false} theme={'dark'} mode={'horizontal'}>
						<Menu.Item onClick={() => navigate(RouteNames.LOGIN)}>
							Войти
						</Menu.Item>
					</Menu>
				</Col>
			</Row>
		</Layout.Header>
	);
};

export default Navbar;
