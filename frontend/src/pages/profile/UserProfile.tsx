import React, {FC, useContext} from 'react';
import {Button, Col, Image, Row, Typography} from "antd";
import {UserContext} from "../../App";
import MainLayout from "../../layouts/MainLayout";
import {useNavigate} from "react-router-dom";
import {RouteNames} from "../../router";

const UserProfile: FC = () => {
	const user = useContext(UserContext);
	const navigate = useNavigate();
	if (!user)
		return <div>Загрузка...</div>
	return (
		<MainLayout>
			<Row justify={'center'}><Typography.Title>Профиль пользователя</Typography.Title></Row>
			<Row justify={'space-evenly'} style={{padding: '10vh 20vw'}}>
				<Col>
					<div>
						<Typography.Title level={4}>Имя</Typography.Title>
						<div>{user.firstName}</div>
					</div>
					<div>
						<Typography.Title level={4}>Фамилия</Typography.Title>
						<div>{user.lastName}</div>
					</div>
					<div>
						<Typography.Title level={4}>Почта</Typography.Title>
						<div>{user.email}</div>
					</div>
				</Col>
				<Col>
					<Image style={{borderRadius: '50px'}} width={200} height={200} src={user.photoUrl}/>
				</Col>
			</Row>
			<Row justify={'center'}>
				<Button onClick={() => navigate(RouteNames.MYBUILDS)} type={'primary'} shape={'round'} size={'large'}>
					<Typography.Title level={4}>Посмотреть мои сборки</Typography.Title>
				</Button>
			</Row>
		</MainLayout>
	);

};

export default UserProfile;