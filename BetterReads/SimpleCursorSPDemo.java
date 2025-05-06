package MySQLDemo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.CallableStatement;
import java.sql.Types;

public class SimpleCursorSPDemo {

	static final String databasePrefix ="cs366-2251_callahank18";
    static final String netID ="callahank18"; // Please enter your netId
    static final String hostName ="washington.uww.edu"; //140.146.23.39 or washington.uww.edu
    static final String databaseURL ="jdbc:mariadb://"+hostName+"/"+databasePrefix;
    static final String password ="kc8958"; // please enter your own password
    	  
	private Connection connection = null;
	private Statement statement = null;
	private ResultSet resultSet = null;

	public void Connection(){

		try {
			Class.forName("org.mariadb.jdbc.Driver");
			System.out.println("databaseURL"+ databaseURL);
			connection = DriverManager.getConnection(databaseURL, netID, password);
			System.out.println("Successfully connected to the database");
		}
		catch (ClassNotFoundException e) {
			e.printStackTrace();
		}
		catch (SQLException e) {
			e.printStackTrace();
		}
	} // end of Connection

	public void simpleCursorSP(String spName) {

	try {
		statement = connection.createStatement();
		String listName;
		CallableStatement myCallStmt = connection.
				prepareCall("{call "+spName+"(?)}");
	    myCallStmt.setString(1,"");
	    myCallStmt.registerOutParameter(1,Types.VARCHAR);
        myCallStmt.execute();
        listName = myCallStmt.getString(1);
        System.out.println("The class list: \n"+listName);

    }
	catch (SQLException e) {
		e.printStackTrace();
	}
} // end of simpleQuery method

	/*
	 * delimiter $$
drop procedure if exists getClassInfo21;
create procedure getClassInfo21(INOUT classList varchar(4000))
begin
declare isDone integer default 0;
declare currentClass varchar(255) default "";
declare currentMeet varchar(255) default "";
declare currentRoom varchar(255) default "";
declare classCursor cursor for
select cname, meets_at, room from Class;
declare continue handler
for not found set isDone = 1;
open classCursor;
getList: loop
fetch classCursor into currentClass, currentMeet, currentRoom;
if isDone = 1 then
leave getList;
end if;
set classList = concat("","\n", classList);
set classList = concat(currentRoom,"\t", classList);
set classList = concat(currentMeet,"\t", classList);
set classList = concat(currentClass,"\t\t", classList);
end loop getList;
close classCursor;
end $$
delimiter ;

	 * 
	 * 
	 * 
	 * 
	 * 
	 */
public static void main(String args[]) {

	SimpleCursorSPDemo demoObj = new SimpleCursorSPDemo();
	demoObj.Connection();
	String spName ="getClassInfo21";
	demoObj.simpleCursorSP(spName);
}

}

