/**
 * root is main function
 * @global input_data
 * @var one_temp_data *get data from webpage
 * @var two_temp_data *save string have been split
 * @var data *save data from object
 * @var object_members *save data when have been handle from string
 * 
 **/
function root() {

    var data = [];
    var object_members = {};
    var input_data = document.getElementById("input_data").value.toLowerCase();
    var one_temp_data = input_data.split("request off:");
    var two_temp_data = [];

    // split data by enter
    for (let i = 1; i < one_temp_data.length; i++) {
        two_temp_data.push(one_temp_data[i].split("\n"));
    }

    // save data to Variable to add in object
    var name_member = handleStringSplit(handleLocationString(two_temp_data, "member", "member name"))
    var time_off = handleTimeOff(handleLocationString(two_temp_data, "time", "time off"));
    var datetime_return = handleTimeReturn(handleLocationString(two_temp_data, "time returning", "time returning to work"))
    var reason = handleStringSplit(handleLocationString(two_temp_data, "reason", "reason details"))

    // add data into object
    for (let i = 0; i < two_temp_data.length; i++) {
        object_members =
        {
            name_member: name_member[i],
            time_off: time_off[i][0],
            from_datetime: time_off[i][1],
            to_datetime: time_off[i][2],
            datetime_return: datetime_return[i],
            reason: reason[i]
        }
        data.push(object_members);
    }

    // export data to table
    handleJsonToTable(data);

    // call JSONToEXCELConvertor infused param to export EXCEL
    //  JSONToEXCELConvertor(JSON.stringify(data), "Request Time Off");
}


// 13:00 - 15:00 19/05/2020
// 13:00- 15:00 19/05/2020
// 13:00 -15:00 19/05/2020


/**
 * handleFormatDate
 * 
 * @param date
 * @var date_temp
 **/
function handleFormatDate(date) {
    var date_temp = date.split(" ");
    if (date_temp.length == 2) {
        return true
    }
    else if (date_temp.length == 4) {
        return date_temp[0] + date_temp[1] + date_temp[2] + " " + date_temp[3];
    } else {
        return date_temp[0] + date_temp[1] + " " + date_temp[2]
    }
}

/**
 * handleStringSplit is function split string for member_name and reason
 @param arr
 @var temp_data *contain substring split from ":"
 @var output *output is returned array containing string have been handled
 @return array
**/
function handleStringSplit(arr) {
    var temp_data = [];
    var output = [];
    try {
        for (const i in arr) {
            temp_data.push(arr[i].substring(arr[i].indexOf(":") + 1, arr[i].length));
        }
        for (const i in temp_data) {
            if ((temp_data[i]).trim() == "") {
                output.push("null");
            } else {
                output.push(handleUnicodeDiacritics(temp_data[i].trim()));
            }
        }
        return output;
    } catch (error) {
        console.log("error from handleStringSplit: ", error);
    }
}

/**
 * handleTimeReturn is function split time for time_return_to_work
 * 
 @param arr
 @var temp_data *contain substring split from ":"
 @var output *output is returned array containing string have been handled
 @return array
**/
function handleTimeReturn(arr) {
    try {
        var temp_data = [];
        var output = [];
        for (const i in arr) {
            temp_data.push(arr[i].substring(arr[i].indexOf(":") + 1, arr[i].length));
        }
        for (const i in temp_data) {
            if ((temp_data[i]).trim() == "") {
                output.push("null");
            } else {
                output.push(temp_data[i].trim());
            }
        }
        return output;
    } catch (error) {
        console.log("error from handleTimeReturn: ", error);
    }
}

/**
 * handleTimeOff is function split time for dayOff, fromDay and toDay 
 * 
 @param arr
 @var temp_data *contain substring date: hh:mm mm/dd/yyyy - hh:mm mm/dd/yyyy
 @var sub_output *assgin the values hours, start datetime and end datetime
 @var hours *hour values ​​are separated from temp_data variable
 @var startDatetime *start datetime values ​​are separated from datetimeStart_End variable in For Loop
 @var endDatetime *end datetime values ​​are separated from datetimeStart_End variable in For Loop
 @var output *output is final returned array containing the array [hours, startDatetime, endDatetime]
 @returns array
**/
function handleTimeOff(arr) {
    var temp_data = [];
    var sub_output = [];
    var output = [];
    var hours;
    var startDatetime;
    var endDatetime;
    var datetimeStart_End;

    for (const i in arr) {
        temp_data.push((arr[i].substring(arr[i].indexOf(":") + 1, arr[i].length)).trim());
    }

    for (var i = 0; i < temp_data.length; i++) {
        try {
            // datetimeStart_End cut characters between '(' ')' to check
            datetimeStart_End = temp_data[i].substring(temp_data[i].indexOf("(") + 1, temp_data[i].indexOf(")"));

            /**check format of datetime which is supported */
            /**
             * format: n hours (hh:mm-hh:mm dd/mm/yyyy)
             * format: n hours (hh:mm - hh:mm dd/mm/yyyy)
             * format: n hours (hh:mm dd/mm/yyyy - hh:mm dd/mm/yyyy)
             * format: hh:mm-hh:mm (dd/mm/yyyy)
             * format: n day (dd/mm/yyyy)
             */
            if (datetimeStart_End.split(" ").length == 1) {

                if (/\d{1,2}\/\d{1,2}\/\d{4}$/.test(datetimeStart_End.trim())) {
                    /**
                     * format: hh:mm-hh:mm (dd/mm/yyyy)
                     * format: n day (dd/mm/yyyy)
                     */

                    var temp_year = datetimeStart_End.split(" ").length == 1 ? datetimeStart_End.trim() : "";

                    //temp_hour[0]:start time; temp_hour[1]: end time;
                    var temp_hour = (temp_data[i].split("(")[0]).split("-");

                    if (/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])/.test(temp_hour[0].trim())) {
                        // for hour format: hh:mm

                        startDatetime = (temp_hour[0].concat(temp_year)).trim();
                        endDatetime = (temp_hour[1].concat(temp_year)).trim();

                        //separetedYeard: [0] = date, [1] = month, [2] = year
                        var separatedYear = temp_year.split("/");

                        //calculate total hours between start and end hour by datetime format: mm/dd/yyyy hh:mm - mm/dd/yyyy hh:mm
                        hours = new Date(separatedYear[1] + "/" + separatedYear[0] + "/" + separatedYear[2] + " " + temp_hour[1]).getHours() -
                            new Date(separatedYear[1] + "/" + separatedYear[0] + "/" + separatedYear[2] + " " + temp_hour[0]).getHours() + " hours";

                        sub_output = [hours, startDatetime, endDatetime];
                        output.push(sub_output);
                    } else if (/\d\s([day])/.test(temp_hour[0].trim())) {
                        //for n day format: n day

                        //separetedYeard: [0] = date, [1] = month, [2] = year
                        var separatedYear = temp_year.split("/");

                        var dateSingle = new Date(separatedYear[1] + "/" + separatedYear[0] + "/" + separatedYear[2] + " " + "00:00");

                        startDatetime = dateSingle.toLocaleDateString();

                        // handle after 1 day
                        var temp_date;
                        temp_date = dateSingle.getDate() + parseInt((temp_hour[0].trim()).split(" ")[0]);

                        do {
                            dateSingle.setDate(temp_date);
                            temp_date = dateSingle.getDate() + 1;
                        } while (dateSingle.getDay() == 0 || dateSingle.getDay() == 6);

                        endDatetime = dateSingle.toLocaleDateString();
                        hours = temp_hour[0].trim();

                        sub_output = [hours, startDatetime, endDatetime];
                        output.push(sub_output);
                    } else {
                        throw "error format datetime"
                    }
                } else {
                    throw "error format datetime";
                }
            } else {
                hours = temp_data[i].split("(").slice(0)[0].trim();
                startDatetime = (datetimeStart_End.split("-").slice(0)[0]).trim();
                endDatetime = (datetimeStart_End.split("-").slice(0)[1]).trim();
                if (/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])-([0-1]?[0-9]|2[0-4]):([0-5][0-9])\s\d{1,2}\/\d{1,2}\/\d{4}$/.test(datetimeStart_End)) {
                    /**
                     * format: n hours (hh:mm-hh:mm dd/mm/yyyy)
                     */
                    startDatetime = startDatetime.concat(" " + datetimeStart_End.split(" ")[1]);
                    sub_output = [hours, startDatetime, endDatetime]
                    output.push(sub_output);
                } else if (/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])\s-\s([0-1]?[0-9]|2[0-4]):([0-5][0-9])\s\d{1,2}\/\d{1,2}\/\d{4}$/.test(datetimeStart_End)) {
                    /**
                     * format: n hours (hh:mm - hh:mm dd/mm/yyyy)
                     */
                    datetimeStart_End = handleFormatDate(datetimeStart_End);
                    startDatetime = startDatetime.concat(" " + datetimeStart_End.split(" ")[1]);
                    sub_output = [hours, startDatetime, endDatetime]
                    output.push(sub_output);
                } else {
                    /**
                     * format: n hours (hh:mm dd/mm/yyyy - hh:mm dd/mm/yyyy)
                     */
                    sub_output = [hours, startDatetime, endDatetime]
                    output.push(sub_output);
                }
            }
        } catch (error) {
            sub_output = ["null", "null", "null"]
            output.push(sub_output);
        }
    }
    return output;
}

/**
 * handleLocationString get right string contain string param
 * 
 @param arr
 @param firstString *is param to compare with string in array
 @param secondString *is param to compare with string in array
 @global temp_data *save string contain string param firstString and secondString
 @return array
 *
**/
function handleLocationString(arr, firstString, secondString) {
    var temp_data = [];
    try {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][1].indexOf(firstString) >= 0 || arr[i][1].indexOf(secondString) >= 0) {
                temp_data.push(arr[i][1]);
            }
            else if (arr[i][2].indexOf(firstString) >= 0 || arr[i][1].indexOf(secondString) >= 0) {
                temp_data.push(arr[i][2]);
            }
            else if (arr[i][3].indexOf(firstString) >= 0 || arr[i][3].indexOf(secondString) >= 0) {
                temp_data.push(arr[i][3]);
            }
            else if (arr[i][4].indexOf(firstString) >= 0 || arr[i][4].indexOf(secondString) >= 0) {
                temp_data.push(arr[i][4]);
            }
            else if (arr[i][5].indexOf(firstString) >= 0 || arr[i][5].indexOf(secondString) >= 0) {
                temp_data.push(arr[i][5]);
            }
            else {
                temp_data.push(secondString + ": null");
            }
        }
        return temp_data;
    } catch (error) {
        console.log("error from handleLocationString: ", error);
    }
}

/**
 * handleCapitalFirstWord
 * @param string
 **/
function handleCapitalFirstWord(string) {
    return string
        .toLowerCase()
        .split(' ')
        .map(function (word) {
            return word[0].toUpperCase() + word.substr(1);
        })
        .join(' ');
}

/**
 * handleUnicodeDiacritics
 * @param string
 **/
function handleUnicodeDiacritics(string) {
    if (string !== null) {
        return handleCapitalFirstWord(string.normalize("NFD").replace(/[\u0300-\u036f]/g, ""))
    } else {
        return string;
    }

}

function getDateTime() {
    var today = new Date();
    return today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
}


/**
 * @param JSONData
 * @param ReportTitle
 * @param ShowLabel
 **/
function JSONToEXCELConvertor(JSONData, ReportTitle) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    var CSV = '';
    //Set Report title in first row or line

    CSV += ReportTitle + '\r\n\n';

    //This condition will generate the Label/Header
    var row = "";
    //This loop will extract the label from 1st index of on array
    for (var index in arrData[0]) {

        //Now convert each value to string and comma-seprated
        row += index + ',';
    }

    row = row.slice(0, -1);

    //append Label row with line break
    CSV += row + '\r\n';

    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }
        row.slice(0, row.length - 1);

        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {
        alert("Invalid data");
        return;
    }

    //Generate a file name
    var fileName = "Report_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g, "_");

    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    

    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");
    link.href = uri;

    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

/**
 * handleJsonToTable
 * 
 * 
 **/
function handleJsonToTable(json) {
    if (json[0] === undefined) {
        alert("Table không được tạo\nVui lòng kiểm tra lại dữ liệu nhập vào");
        // show bnt table when data invalid
        showBntExport(0, 1);
    } else {
        var col = [];
        for (const i in json[0]) {
            if (col.indexOf(i) === -1) {
                col.push(i);
            }
        }
        // Create a tag table
        var table = document.createElement("table");

        // Create a tag thead
        var thead = document.createElement("thead");

        // Create a tag tr into thead.
        var tr_in_thead = document.createElement("tr")

        // Create id for table
        table.id = "table-data";

        // Create table header row using the extracted headers above.
        var tr = table.insertRow(-1); // table row to get "tr".
        table.appendChild(thead);
        thead.appendChild(tr_in_thead);
        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th"); // table header.
            th.innerHTML = col[i];
            th.style.textAlign = "left";
            th.style.textTransform = "uppercase";
            th.style.paddingRight = "15px";
            th.style.paddingBottom = "15px";
            tr_in_thead.appendChild(th);
        }

        // add json data to the table as rows.
        var count = 0;
        for (var i = 0; i < json.length; i++) {
            tr = table.insertRow(-1);
            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = json[i][col[j]];
                tabCell.id = "id" + count;
                tabCell.onclick = function () {
                    for (var u = 0; u < count; u++) {
                        document.getElementById("id" + u).contentEditable = true;
                    }
                }
                count++;
            }
        }

        // Now, add the newly created table with json data, to a container.
        var show_Data_Table = document.getElementById("content-table");
        show_Data_Table.innerHTML = "";
        show_Data_Table.appendChild(table);

        // show bnt export when export data to table
        showBntExportExcel();
    }
}

/**
 * handleTableToExcel
 * 
 * 
 **/
function handleTableToExcel() {
    var i, j;
    var csv = "";

    var table = document.getElementById("table-data");
    var table_headings = table.children[1].children[0].children;
    var table_body_rows = table.children[0].children;
    var heading;
    var headingsArray = [];
    for (i = i; i < table_headings.length; i++) {
        heading = table_headings[i];
        headingsArray.push('"' + heading.innerHTML + '"');
    }
    csv += headingsArray.join(',') + ";\n";

    var row;
    var columns;
    var column;
    var columnsArray;
    for (i = 0; i < table_body_rows.length; i++) {
        row = table_body_rows[i];
        columns = row.children;
        columnsArray = [];
        for (j = 0; j < columns.length; j++) {
            var column = columns[j];
            columnsArray.push('"' + column.innerHTML + '"');
        }
        csv += columnsArray.join(',') + "\n";
    }
    download("[" + getDateTime() + "] - Request_time_off.csv", csv);
}

function download(filename, text) {
    var pom = document.createElement('a');
    pom.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(text));
    pom.setAttribute('download', filename);

    if (document.createEvent) {
        var event = document.createEvent('MouseEvents');
        event.initEvent('click', true, true);
        pom.dispatchEvent(event);
    }
    else {
        pom.click();
    }
}

function showBntExportExcel() {
    document.getElementById("export-excel").style.display = "block";
}