import React, {FC, useContext} from 'react';
import {Col, Row} from 'antd';
import {TypeName} from '../../../models/type/types';
import {DeleteOutlined, SettingOutlined} from '@ant-design/icons';
import {GetComponentDto} from '../../../models/component/get-component.dto';
import {UserContext} from "../../../App";
import {checkIsAdmin} from "../../../utils/user/check-is-admin";

interface ComponentItemHeaderProps {
	component: GetComponentDto;
	onDelete: (component: GetComponentDto) => void
	onUpdate: (component: GetComponentDto) => void
}

const ComponentHeader: FC<ComponentItemHeaderProps> = ({component, onUpdate, onDelete}) => {
	const {name, type} = component;
	const user = useContext(UserContext);
	const isAdmin = (user && checkIsAdmin(user)) || false;

	const handleOnDelete = (
		e: React.MouseEvent<HTMLSpanElement>,
		component: GetComponentDto,
	) => {
		e.stopPropagation();
		onDelete(component)
	};

	const handleOnUpdate = (
		e: React.MouseEvent<HTMLSpanElement>,
		component: GetComponentDto,
	) => {
		e.stopPropagation();
		onUpdate(component)
	};
	return (
		<div className={'component-header'}>
			<Row justify={'space-evenly'} className={'component-item'}>
				<Col>{name}</Col>
				<Col>{TypeName[type]}</Col>
				{isAdmin &&
                    <div className={'icon-group'}>
                        <Col
                            onClick={e => handleOnDelete(e, component)}
                            className={'edit-component-icon-container'}
                        >
                            <DeleteOutlined/>
                        </Col>
                        <Col
                            onClick={e => handleOnUpdate(e, component)}
                            className={'edit-component-icon-container'}
                        >
                            <SettingOutlined/>
                        </Col>
                    </div>

				}
			</Row>
		</div>
	);
};

export default ComponentHeader;
