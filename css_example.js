function CSSExample() {
    var E_def = [
    /*e[1/0]:*/10,
    /*e[2/0]:*/10,
    /*e[2/1]:*/0,
    /*e[3/0]:*/10,
    /*e[3/1]:*/10,
    /*e[3/2]:*/10,
    /*e[4/0]:*/10,
    /*e[4/1]:*/10,
    /*e[4/2]:*/10,
    /*e[4/3]:*/10,
    /*e[5/0]:*/10,
    /*e[5/1]:*/10,
    /*e[5/2]:*/10,
    /*e[5/3]:*/10,
    /*e[5/4]:*/10,
    /*e[6/0]:*/10,
    /*e[6/1]:*/10,
    /*e[6/2]:*/10,
    /*e[6/3]:*/10,
    /*e[6/4]:*/10,
    /*e[6/5]:*/10,
    /*e[7/0]:*/10,
    /*e[7/1]:*/10,
    /*e[7/2]:*/10,
    /*e[7/3]:*/10,
    /*e[7/4]:*/10,
    /*e[7/5]:*/10,
    /*e[7/6]:*/10,
    /*e[8/0]:*/10,
    /*e[8/1]:*/10,
    /*e[8/2]:*/10,
    /*e[8/3]:*/10,
    /*e[8/4]:*/10,
    /*e[8/5]:*/10,
    /*e[8/6]:*/10,
    /*e[8/7]:*/0,
    /*e[9/0]:*/10,
    /*e[9/1]:*/10,
    /*e[9/2]:*/10,
    /*e[9/3]:*/10,
    /*e[9/4]:*/10,
    /*e[9/5]:*/10,
    /*e[9/6]:*/10,
    /*e[9/7]:*/0,
    /*e[9/8]:*/0,
    /*e[10/0]:*/10,
    /*e[10/1]:*/10,
    /*e[10/2]:*/10,
    /*e[10/3]:*/10,
    /*e[10/4]:*/10,
    /*e[10/5]:*/10,
    /*e[10/6]:*/10,
    /*e[10/7]:*/10,
    /*e[10/8]:*/10,
    /*e[10/9]:*/10,
    /*e[11/0]:*/10,
    /*e[11/1]:*/10,
    /*e[11/2]:*/10,
    /*e[11/3]:*/10,
    /*e[11/4]:*/10,
    /*e[11/5]:*/10,
    /*e[11/6]:*/10,
    /*e[11/7]:*/10,
    /*e[11/8]:*/10,
    /*e[11/9]:*/10,
    /*e[11/10]:*/10,
    /*e[12/0]:*/10,
    /*e[12/1]:*/10,
    /*e[12/2]:*/10,
    /*e[12/3]:*/10,
    /*e[12/4]:*/10,
    /*e[12/5]:*/10,
    /*e[12/6]:*/10,
    /*e[12/7]:*/10,
    /*e[12/8]:*/10,
    /*e[12/9]:*/10,
    /*e[12/10]:*/10,
    /*e[12/11]:*/0,
    /*e[13/0]:*/10,
    /*e[13/1]:*/10,
    /*e[13/2]:*/10,
    /*e[13/3]:*/10,
    /*e[13/4]:*/10,
    /*e[13/5]:*/10,
    /*e[13/6]:*/10,
    /*e[13/7]:*/10,
    /*e[13/8]:*/10,
    /*e[13/9]:*/10,
    /*e[13/10]:*/10,
    /*e[13/11]:*/10,
    /*e[13/12]:*/10,
    /*e[14/0]:*/10,
    /*e[14/1]:*/10,
    /*e[14/2]:*/10,
    /*e[14/3]:*/10,
    /*e[14/4]:*/10,
    /*e[14/5]:*/10,
    /*e[14/6]:*/10,
    /*e[14/7]:*/10,
    /*e[14/8]:*/10,
    /*e[14/9]:*/10,
    /*e[14/10]:*/10,
    /*e[14/11]:*/10,
    /*e[14/12]:*/10,
    /*e[14/13]:*/0,
    /*e[15/0]:*/10,
    /*e[15/1]:*/10,
    /*e[15/2]:*/10,
    /*e[15/3]:*/10,
    /*e[15/4]:*/10,
    /*e[15/5]:*/10,
    /*e[15/6]:*/10,
    /*e[15/7]:*/10,
    /*e[15/8]:*/10,
    /*e[15/9]:*/10,
    /*e[15/10]:*/10,
    /*e[15/11]:*/10,
    /*e[15/12]:*/10,
    /*e[15/13]:*/10,
    /*e[15/14]:*/10,
    /*e[16/0]:*/10,
    /*e[16/1]:*/10,
    /*e[16/2]:*/10,
    /*e[16/3]:*/10,
    /*e[16/4]:*/10,
    /*e[16/5]:*/10,
    /*e[16/6]:*/10,
    /*e[16/7]:*/10,
    /*e[16/8]:*/10,
    /*e[16/9]:*/10,
    /*e[16/10]:*/10,
    /*e[16/11]:*/10,
    /*e[16/12]:*/10,
    /*e[16/13]:*/10,
    /*e[16/14]:*/10,
    /*e[16/15]:*/0,
    /*e[17/0]:*/10,
    /*e[17/1]:*/10,
    /*e[17/2]:*/10,
    /*e[17/3]:*/10,
    /*e[17/4]:*/10,
    /*e[17/5]:*/10,
    /*e[17/6]:*/10,
    /*e[17/7]:*/10,
    /*e[17/8]:*/10,
    /*e[17/9]:*/10,
    /*e[17/10]:*/10,
    /*e[17/11]:*/10,
    /*e[17/12]:*/10,
    /*e[17/13]:*/10,
    /*e[17/14]:*/10,
    /*e[17/15]:*/0,
    /*e[17/16]:*/0,
    /*e[18/0]:*/10,
    /*e[18/1]:*/10,
    /*e[18/2]:*/10,
    /*e[18/3]:*/10,
    /*e[18/4]:*/10,
    /*e[18/5]:*/10,
    /*e[18/6]:*/10,
    /*e[18/7]:*/10,
    /*e[18/8]:*/10,
    /*e[18/9]:*/10,
    /*e[18/10]:*/10,
    /*e[18/11]:*/10,
    /*e[18/12]:*/10,
    /*e[18/13]:*/10,
    /*e[18/14]:*/10,
    /*e[18/15]:*/10,
    /*e[18/16]:*/10,
    /*e[18/17]:*/10,
    ]

    var A_def = [
    /*1:*/"color: green",
    /*2:*/"color: red",
    /*3:*/"font-style: italic",
    /*4:*/"font-weight: bold",
    /*5:*/"text-decoration: line-through",
    /*6:*/"letter-spacing: 8px",
    /*7:*/"text-align: center",
    /*8:*/"text-align: justify",
    /*9:*/"text-align: right",
    /*10:*/"line-height: 3em",
    /*11:*/"font-family: 'Times New Roman'",
    /*12:*/"font-family: Arial",
    /*13:*/"background-color: lightblue",
    /*14:*/"background-color: lightgrey",
    /*15:*/"border-style: simple",
    /*16:*/"border-style: dotted",
    /*17:*/"border-style: dashed",
    /*18:*/"font-size: 30px",
    ]

    var A_diff = [
        /*1:*/1,
        /*2:*/1,
        /*3:*/1,
        /*4:*/1,
        /*5:*/1,
        /*6:*/1,
        /*7:*/1,
        /*8:*/1,
        /*9:*/1,
        /*10:*/1,
        /*11:*/1,
        /*12:*/1,
        /*13:*/1,
        /*14:*/1,
        /*15:*/1,
        /*16:*/1,
        /*17:*/1,
        /*18:*/1,
        ]


    var TaskNum = 18;

    document.getElementById("NumberOfTasks").value = TaskNum;
    DefineTasks();
    var Table = document.getElementById("E");
    var Tasks = document.getElementById("Tasks");
    count=0; 
            for (var i = 0, row; row = Table.rows[i]; i++) {
                for (var j = 0, col; col = row.cells[j]; j++) {
                    if (i!=j) {
                        col.children[0].value= E_def[count];
                        count++;
                    }   
                }     
            }
    count=0;
    for (var i = 0, row; row = Table.rows[i]; i++) {
        Tasks.rows[i].children[0].children[0].value=A_def[count];
        count++;
    }
    count=0;
    for (var i = 0, row; row = Table.rows[i]; i++) {
        Tasks.rows[i].children[1].children[0].value=A_diff[count];
        count++;
    }
    $("#ToggleDifficultyButton").prop("disabled", true).css('opacity',0.5);
    $("#NumberOfTasks").prop("readonly", true).css('opacity',0.5);
    $("#NumberOfTasksButton").prop("disabled", true).css('opacity',0.5);
    $("#PopSize").prop("readonly", true).css('opacity',0.5);
    $("#TSize").prop("readonly", true).css('opacity',0.5);
    $(".DCell").prop("readonly", true).css('opacity',0.5);
    $(".ECell").prop("readonly", true).css('opacity',0.5);
    $(".ACell").prop("readonly", true).css('opacity',0.5);
    if (Difficulty_disabled==false) {
        ToggleDifficulty();
    }
}
