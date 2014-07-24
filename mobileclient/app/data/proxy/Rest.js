Ext.define('Kontaktliste.data.proxy.Rest', 
{
    override: 'Ext.data.proxy.Rest',
    config: 
	{
        appendId: false,
    },

    buildUrl: function(request) 
	{
        var operation = request.getOperation();
        var action = operation.getAction();
		if  (action != 'update' && action != 'destroy')
		{
			return this.callParent(arguments);
		}
		
		var records   = operation.getRecords();
		request.setUrl(records[0].get('url'));
		return this.callParent([request]);
	},
	
	doRequest: function(operation, callback, scope)
	{
		var action = operation.getAction();
		if  (action != 'update' && action != 'destroy')
		{
			return this.callParent(arguments);
		}
		
		var headers = this.getHeaders();
		try 
		{
			headers['If-Match'] = operation.getRecords()[0].data.cVersion;
			return this.callParent(arguments);
		} finally
			{
				delete headers['If-Match'];
			}
	}
});