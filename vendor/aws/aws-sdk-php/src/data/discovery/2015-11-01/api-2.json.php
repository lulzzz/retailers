<?php
// This file was auto-generated from sdk-root/src/data/discovery/2015-11-01/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2015-11-01', 'endpointPrefix' => 'discovery', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'AWS Application Discovery Service', 'signatureVersion' => 'v4', 'targetPrefix' => 'AWSPoseidonService_V2015_11_01', 'uid' => 'discovery-2015-11-01', ], 'operations' => [ 'CreateTags' => [ 'name' => 'CreateTags', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateTagsRequest', ], 'output' => [ 'shape' => 'CreateTagsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'DeleteTags' => [ 'name' => 'DeleteTags', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteTagsRequest', ], 'output' => [ 'shape' => 'DeleteTagsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'DescribeAgents' => [ 'name' => 'DescribeAgents', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeAgentsRequest', ], 'output' => [ 'shape' => 'DescribeAgentsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'DescribeConfigurations' => [ 'name' => 'DescribeConfigurations', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeConfigurationsRequest', ], 'output' => [ 'shape' => 'DescribeConfigurationsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'DescribeExportConfigurations' => [ 'name' => 'DescribeExportConfigurations', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeExportConfigurationsRequest', ], 'output' => [ 'shape' => 'DescribeExportConfigurationsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'DescribeTags' => [ 'name' => 'DescribeTags', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeTagsRequest', ], 'output' => [ 'shape' => 'DescribeTagsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'ExportConfigurations' => [ 'name' => 'ExportConfigurations', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'output' => [ 'shape' => 'ExportConfigurationsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], [ 'shape' => 'OperationNotPermittedException', ], ], ], 'ListConfigurations' => [ 'name' => 'ListConfigurations', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListConfigurationsRequest', ], 'output' => [ 'shape' => 'ListConfigurationsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'StartDataCollectionByAgentIds' => [ 'name' => 'StartDataCollectionByAgentIds', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'StartDataCollectionByAgentIdsRequest', ], 'output' => [ 'shape' => 'StartDataCollectionByAgentIdsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], 'StopDataCollectionByAgentIds' => [ 'name' => 'StopDataCollectionByAgentIds', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'StopDataCollectionByAgentIdsRequest', ], 'output' => [ 'shape' => 'StopDataCollectionByAgentIdsResponse', ], 'errors' => [ [ 'shape' => 'AuthorizationErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidParameterValueException', ], [ 'shape' => 'ServerInternalErrorException', ], ], ], ], 'shapes' => [ 'AgentConfigurationStatus' => [ 'type' => 'structure', 'members' => [ 'agentId' => [ 'shape' => 'String', ], 'operationSucceeded' => [ 'shape' => 'Boolean', ], 'description' => [ 'shape' => 'String', ], ], ], 'AgentConfigurationStatusList' => [ 'type' => 'list', 'member' => [ 'shape' => 'AgentConfigurationStatus', ], ], 'AgentId' => [ 'type' => 'string', ], 'AgentIds' => [ 'type' => 'list', 'member' => [ 'shape' => 'AgentId', ], ], 'AgentInfo' => [ 'type' => 'structure', 'members' => [ 'agentId' => [ 'shape' => 'AgentId', ], 'hostName' => [ 'shape' => 'String', ], 'agentNetworkInfoList' => [ 'shape' => 'AgentNetworkInfoList', ], 'connectorId' => [ 'shape' => 'String', ], 'version' => [ 'shape' => 'String', ], 'health' => [ 'shape' => 'AgentStatus', ], ], ], 'AgentNetworkInfo' => [ 'type' => 'structure', 'members' => [ 'ipAddress' => [ 'shape' => 'String', ], 'macAddress' => [ 'shape' => 'String', ], ], ], 'AgentNetworkInfoList' => [ 'type' => 'list', 'member' => [ 'shape' => 'AgentNetworkInfo', ], ], 'AgentStatus' => [ 'type' => 'string', 'enum' => [ 'HEALTHY', 'UNHEALTHY', 'RUNNING', 'UNKNOWN', 'BLACKLISTED', 'SHUTDOWN', ], ], 'AgentsInfo' => [ 'type' => 'list', 'member' => [ 'shape' => 'AgentInfo', ], ], 'AuthorizationErrorException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'Boolean' => [ 'type' => 'boolean', ], 'Condition' => [ 'type' => 'string', ], 'Configuration' => [ 'type' => 'map', 'key' => [ 'shape' => 'String', ], 'value' => [ 'shape' => 'String', ], ], 'ConfigurationId' => [ 'type' => 'string', ], 'ConfigurationIdList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ConfigurationId', ], ], 'ConfigurationItemType' => [ 'type' => 'string', 'enum' => [ 'SERVER', 'PROCESS', 'CONNECTION', ], ], 'ConfigurationTag' => [ 'type' => 'structure', 'members' => [ 'configurationType' => [ 'shape' => 'ConfigurationItemType', ], 'configurationId' => [ 'shape' => 'ConfigurationId', ], 'key' => [ 'shape' => 'TagKey', ], 'value' => [ 'shape' => 'TagValue', ], 'timeOfCreation' => [ 'shape' => 'TimeStamp', ], ], ], 'ConfigurationTagSet' => [ 'type' => 'list', 'member' => [ 'shape' => 'ConfigurationTag', 'locationName' => 'item', ], ], 'Configurations' => [ 'type' => 'list', 'member' => [ 'shape' => 'Configuration', ], ], 'ConfigurationsDownloadUrl' => [ 'type' => 'string', ], 'ConfigurationsExportId' => [ 'type' => 'string', ], 'CreateTagsRequest' => [ 'type' => 'structure', 'required' => [ 'configurationIds', 'tags', ], 'members' => [ 'configurationIds' => [ 'shape' => 'ConfigurationIdList', ], 'tags' => [ 'shape' => 'TagSet', ], ], ], 'CreateTagsResponse' => [ 'type' => 'structure', 'members' => [], ], 'DeleteTagsRequest' => [ 'type' => 'structure', 'required' => [ 'configurationIds', ], 'members' => [ 'configurationIds' => [ 'shape' => 'ConfigurationIdList', ], 'tags' => [ 'shape' => 'TagSet', ], ], ], 'DeleteTagsResponse' => [ 'type' => 'structure', 'members' => [], ], 'DescribeAgentsRequest' => [ 'type' => 'structure', 'members' => [ 'agentIds' => [ 'shape' => 'AgentIds', ], 'maxResults' => [ 'shape' => 'Integer', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeAgentsResponse' => [ 'type' => 'structure', 'members' => [ 'agentsInfo' => [ 'shape' => 'AgentsInfo', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeConfigurationsAttribute' => [ 'type' => 'map', 'key' => [ 'shape' => 'String', ], 'value' => [ 'shape' => 'String', ], ], 'DescribeConfigurationsAttributes' => [ 'type' => 'list', 'member' => [ 'shape' => 'DescribeConfigurationsAttribute', ], ], 'DescribeConfigurationsRequest' => [ 'type' => 'structure', 'required' => [ 'configurationIds', ], 'members' => [ 'configurationIds' => [ 'shape' => 'ConfigurationIdList', ], ], ], 'DescribeConfigurationsResponse' => [ 'type' => 'structure', 'members' => [ 'configurations' => [ 'shape' => 'DescribeConfigurationsAttributes', ], ], ], 'DescribeExportConfigurationsRequest' => [ 'type' => 'structure', 'members' => [ 'exportIds' => [ 'shape' => 'ExportIds', ], 'maxResults' => [ 'shape' => 'Integer', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeExportConfigurationsResponse' => [ 'type' => 'structure', 'members' => [ 'exportsInfo' => [ 'shape' => 'ExportsInfo', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeTagsRequest' => [ 'type' => 'structure', 'members' => [ 'filters' => [ 'shape' => 'TagFilters', ], 'maxResults' => [ 'shape' => 'Integer', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeTagsResponse' => [ 'type' => 'structure', 'members' => [ 'tags' => [ 'shape' => 'ConfigurationTagSet', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'ExportConfigurationsResponse' => [ 'type' => 'structure', 'members' => [ 'exportId' => [ 'shape' => 'ConfigurationsExportId', ], ], ], 'ExportIds' => [ 'type' => 'list', 'member' => [ 'shape' => 'ConfigurationsExportId', ], ], 'ExportInfo' => [ 'type' => 'structure', 'required' => [ 'exportId', 'exportStatus', 'statusMessage', 'exportRequestTime', ], 'members' => [ 'exportId' => [ 'shape' => 'ConfigurationsExportId', ], 'exportStatus' => [ 'shape' => 'ExportStatus', ], 'statusMessage' => [ 'shape' => 'ExportStatusMessage', ], 'configurationsDownloadUrl' => [ 'shape' => 'ConfigurationsDownloadUrl', ], 'exportRequestTime' => [ 'shape' => 'ExportRequestTime', ], ], ], 'ExportRequestTime' => [ 'type' => 'timestamp', ], 'ExportStatus' => [ 'type' => 'string', 'enum' => [ 'FAILED', 'SUCCEEDED', 'IN_PROGRESS', ], ], 'ExportStatusMessage' => [ 'type' => 'string', ], 'ExportsInfo' => [ 'type' => 'list', 'member' => [ 'shape' => 'ExportInfo', ], ], 'Filter' => [ 'type' => 'structure', 'required' => [ 'name', 'values', 'condition', ], 'members' => [ 'name' => [ 'shape' => 'String', ], 'values' => [ 'shape' => 'FilterValues', ], 'condition' => [ 'shape' => 'Condition', ], ], ], 'FilterName' => [ 'type' => 'string', ], 'FilterValue' => [ 'type' => 'string', ], 'FilterValues' => [ 'type' => 'list', 'member' => [ 'shape' => 'FilterValue', 'locationName' => 'item', ], ], 'Filters' => [ 'type' => 'list', 'member' => [ 'shape' => 'Filter', ], ], 'Integer' => [ 'type' => 'integer', ], 'InvalidParameterException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'InvalidParameterValueException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'ListConfigurationsRequest' => [ 'type' => 'structure', 'required' => [ 'configurationType', ], 'members' => [ 'configurationType' => [ 'shape' => 'ConfigurationItemType', ], 'filters' => [ 'shape' => 'Filters', ], 'maxResults' => [ 'shape' => 'Integer', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'ListConfigurationsResponse' => [ 'type' => 'structure', 'members' => [ 'configurations' => [ 'shape' => 'Configurations', ], 'nextToken' => [ 'shape' => 'NextToken', ], ], ], 'Message' => [ 'type' => 'string', ], 'NextToken' => [ 'type' => 'string', ], 'OperationNotPermittedException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'ServerInternalErrorException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, 'fault' => true, ], 'StartDataCollectionByAgentIdsRequest' => [ 'type' => 'structure', 'required' => [ 'agentIds', ], 'members' => [ 'agentIds' => [ 'shape' => 'AgentIds', ], ], ], 'StartDataCollectionByAgentIdsResponse' => [ 'type' => 'structure', 'members' => [ 'agentsConfigurationStatus' => [ 'shape' => 'AgentConfigurationStatusList', ], ], ], 'StopDataCollectionByAgentIdsRequest' => [ 'type' => 'structure', 'required' => [ 'agentIds', ], 'members' => [ 'agentIds' => [ 'shape' => 'AgentIds', ], ], ], 'StopDataCollectionByAgentIdsResponse' => [ 'type' => 'structure', 'members' => [ 'agentsConfigurationStatus' => [ 'shape' => 'AgentConfigurationStatusList', ], ], ], 'String' => [ 'type' => 'string', ], 'Tag' => [ 'type' => 'structure', 'required' => [ 'key', 'value', ], 'members' => [ 'key' => [ 'shape' => 'TagKey', ], 'value' => [ 'shape' => 'TagValue', ], ], ], 'TagFilter' => [ 'type' => 'structure', 'required' => [ 'name', 'values', ], 'members' => [ 'name' => [ 'shape' => 'FilterName', ], 'values' => [ 'shape' => 'FilterValues', ], ], ], 'TagFilters' => [ 'type' => 'list', 'member' => [ 'shape' => 'TagFilter', ], ], 'TagKey' => [ 'type' => 'string', ], 'TagSet' => [ 'type' => 'list', 'member' => [ 'shape' => 'Tag', 'locationName' => 'item', ], ], 'TagValue' => [ 'type' => 'string', ], 'TimeStamp' => [ 'type' => 'timestamp', ], ],];