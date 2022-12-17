import { BuildCompatibleStatus } from './build-compatible-status';
import { EnergyConsumptionStatus } from './energy-consumption';
import { RequirementComponentsStatus } from './requirement-components-status';

export class CheckBuildResult {
	public isReady: boolean;
	public buildCompatibleStatus: BuildCompatibleStatus;
	public energyConsumptionStatus: EnergyConsumptionStatus;
	public requirementComponentsStatus: RequirementComponentsStatus;
}
