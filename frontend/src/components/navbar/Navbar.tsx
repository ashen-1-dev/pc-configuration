import React, {FC, useContext} from 'react';
import {Col, Image, Layout, Menu, Row} from 'antd';
import {useNavigate} from 'react-router-dom';
import {RouteNames} from '../../router';
import {removeAuthToken} from '../../utils/storage';
import {UserContext} from '../../App';

const Navbar: FC = () => {
	const navigate = useNavigate();

	const user = useContext(UserContext);

	const handleLogout = () => {
		removeAuthToken();
		navigate(RouteNames.MAIN);
		window.location.reload();
	};

	return (
		<Layout.Header>
			<Row justify={'space-between'}>
				<Col span={9} offset={6}>
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
						<Menu.Item
							key={4}
							onClick={() => navigate(RouteNames.COMPONENTS)}
						>
							Компоненты
						</Menu.Item>
						<Menu.Item
							onClick={() => navigate(RouteNames.USERSBUILDS)}
							key={5}
						>
							Посмотреть сборки пользователей
						</Menu.Item>
					</Menu>
				</Col>
				<Col span={6}>
					<Menu selectable={false} theme={'dark'} mode={'horizontal'}>
						{user == null ? (
							<Menu.Item
								key={6}
								onClick={() => navigate(RouteNames.LOGIN)}
							>
								Войти
							</Menu.Item>
						) : (
							<>
								<Menu.Item
									key={7}
									onClick={() =>
										navigate(RouteNames.PROFILE)
									}
								>
									Здравствуйте, {user.firstName}
									{
										user.photoUrl &&
                                        <span style={{paddingLeft: '10px'}}>
											<Image style={{borderRadius: '50px'}} preview={false} width={40} height={40}
                                                   src={user?.photoUrl}/>
										</span>
									}
									
								</Menu.Item>
								<Menu.Item
									key={8}
									onClick={() => handleLogout()}
								>
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
