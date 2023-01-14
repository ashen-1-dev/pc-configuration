import React, { FC, useState } from 'react';
import { Input, Select, Space } from 'antd';
import { useQuery } from '@tanstack/react-query';
import ComponentTypeService from '../../../services/type/component-type.service';
import { GetComponentTypeDto } from '../../../models/type/GetComponentType.dto';
import { ComponentQuery } from '../../../services/component/component-query';
import { TypeName } from '../../../models/type/types';

interface ComponentSearchProps {
	onQueryChange: (query: Partial<ComponentQuery>) => void;
	type?: GetComponentTypeDto;
}

const ComponentSearch: FC<ComponentSearchProps> = ({ onQueryChange }) => {
	useQuery({
		queryKey: ['get component types'],
		queryFn: ComponentTypeService.getComponentTypes,
		onSuccess: data => setTypes(data),
		refetchInterval: false,
		refetchOnWindowFocus: false,
	});
	const [types, setTypes] = useState<GetComponentTypeDto[]>([]);
	const options = [
		{
			value: null,
			label: 'Любой',
		},
		...types.map(type => ({
			value: type.name,
			label: TypeName[type.name],
		})),
	];

	const onTypeChange = (value: string) => {
		if (value == null) {
			onQueryChange({ type: '' });
			return;
		}
		onQueryChange({ type: value });
	};

	return (
		<Space size={'large'}>
			<Input
				size={'large'}
				onChange={e => onQueryChange({ search: e.currentTarget.value })}
				placeholder={'Поиск'}
			/>

			<Select
				style={{ width: '10rem' }}
				size={'large'}
				placeholder={'Тип'}
				options={options}
				onChange={value => onTypeChange(value)}
			/>
		</Space>
	);
};

export default ComponentSearch;
