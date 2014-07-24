Ext.define('Kontaktliste.plugin.PullRefresh', 
{
    override: 'Ext.plugin.PullRefresh',
    onLatestFetched: function(operation) 
	{
        var store = this.getList().getStore(),
          oldRecords = store.getData(),
          newRecords = operation.getRecords(),
          length = newRecords.length,
          toInsert = [],
          newRecord, oldRecord, i;

        for (i = 0; i < length; i++) 
		{
            newRecord = newRecords[i];
            oldRecord = oldRecords.getByKey(newRecord.getId());

            if (oldRecord) 
			{
                oldRecord.set(newRecord.getData());
            } else 
				{
					toInsert.push(newRecord);
				}

            oldRecord = undefined;
        }

        store.insert(0, toInsert);
		
		var toRemove = [],
		  newRecordsIds = Ext.Array.map(newRecords, function(record)
		  {
			  return record.getId();
		  });
	}
});
