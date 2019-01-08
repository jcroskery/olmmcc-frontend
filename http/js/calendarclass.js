class calendarclass{
    constructor(date, name, starttime, endtime, description){
        this.date = date;
        this.name = name;
        this.starttime = starttime;
        this.endtime = endtime;
        this.description = description;
    }
    isCorrectDate(testDate){
        
        if(testDate.toDateString() == this.date.toDateString()){
            return true;
        }
        return false;
    }
    get getName(){
        return this.name;
    }
    get getTime(){
        return this.starttime + " to " + this.endtime;
    }
    get getDate(){
        return this.date;
    }
    get getDescription() {
        return this.description;
    }
}