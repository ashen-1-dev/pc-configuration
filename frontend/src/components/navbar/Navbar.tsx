import React, { FC } from 'react';
import { Col, Layout, Menu, Row } from 'antd';
import { useNavigate } from 'react-router-dom';
import { RouteNames } from '../../router';
import { useQuery } from '@tanstack/react-query';
import { GetUserDto } from '../../models/user/get-user.dto';
import AuthServce from '../../services/auth/AuthServce';
import { removeAuthToken } from '../../utils/storage';

const Navbar: FC = () => {
	const navigate = useNavigate();
	const { data, isSuccess } = useQuery<GetUserDto>({
		queryKey: ['get auth user'],
		queryFn: async () => await AuthServce.authUser(),
		retry: false,
		refetchOnWindowFocus: false,
		onError: () => {
			removeAuthToken();
		},
	});

	const handleLogout = () => {
		removeAuthToken();
		navigate(0);
	};

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
						<Menu.Item
							onClick={() => navigate(RouteNames.CREATEBUILD)}
							key={2}
						>
							Сборка
						</Menu.Item>
						<Menu.Item key={3}>О нас</Menu.Item>
						<Menu.Item key={4}>FAQ</Menu.Item>
					</Menu>
				</Col>
				<Col span={5}>
					<Menu selectable={false} theme={'dark'} mode={'horizontal'}>
						{!isSuccess ? (
							<Menu.Item
								onClick={() => navigate(RouteNames.LOGIN)}
							>
								Войти
							</Menu.Item>
						) : (
							<>
								<Menu.Item>
									Здравствуйте, {data.firstName}
								</Menu.Item>
								<Menu.Item onClick={() => handleLogout()}>
									Выйти
								</Menu.Item>
							</>
						)}
					</Menu>
				</Col>
			</Row>
		</Layout.Header>
	);
};

export default Navbar;
