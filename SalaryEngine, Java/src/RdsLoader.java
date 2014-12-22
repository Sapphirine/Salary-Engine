import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Collections;
import java.util.HashMap;
import java.util.HashSet;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.Set;

import org.apache.mahout.cf.taste.common.TasteException;
import org.apache.mahout.cf.taste.impl.model.file.FileDataModel;
import org.apache.mahout.cf.taste.impl.neighborhood.ThresholdUserNeighborhood;
import org.apache.mahout.cf.taste.impl.recommender.GenericUserBasedRecommender;
import org.apache.mahout.cf.taste.impl.similarity.EuclideanDistanceSimilarity;
import org.apache.mahout.cf.taste.model.DataModel;
import org.apache.mahout.cf.taste.neighborhood.UserNeighborhood;
import org.apache.mahout.cf.taste.recommender.RecommendedItem;
import org.apache.mahout.cf.taste.recommender.UserBasedRecommender;
import org.apache.mahout.cf.taste.similarity.UserSimilarity;

public class RdsLoader {
	
	final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
	final String DB_URL = "XX";
	Connection conn;

	private String password = null;;
    
    private static RdsLoader instance = null;
    private RdsLoader() {
    	conn = null;
    }
    
    public static RdsLoader getInstance() {
    	if (instance == null)
    		instance = new RdsLoader();
    	return instance;
    }
    
    public boolean isConnected() {
    	return conn != null;
    }
    
    public void setPassword(String password) {
    	this.password = password;
    }
    
    public boolean isPasswordSet() {
    	return this.password != null;
    }
	
    public static void main(String[] args) throws IOException, TasteException {
    	RdsLoader instance = RdsLoader.getInstance();
    	instance.init();
//    	List<Records> records = instance.recommmend("carr@gmail.com");
//    	for (int i=0;i<records.size();i++) {
//    		System.out.println(records.get(i).similarity);
//    	}
//    	instance.createUsersTable();
//    	instance.insert("Users");
    	instance.selectAll("Users");
//    	instance.deleteTable("Comments");
//    	String email="abcdefg";
//    	email=email.replace("abc", "@");
//    	System.out.println(email);
//    	System.out.println(helper.getSalaryPoint(42000,30000));
//    	instance.createCommentsTable();
//    	instance.insertCommentsTable(1, "Gregory Martin International", "I have a interview with this company, quite nice people, however I didnot get the offer....", 2, "2014-12-10 17:09:12");
//    	instance.insertCommentsTable(1, "Gregory Martin International", "Again, I recommend this company, I just find many people around me have submitted the resume to this company, just prepare, and you will make it!", 2, "2014-12-10 17:09:12");
//    	instance.selectAllComments();
//    	System.out.println(instance.recommendCompany(3));
    }
    
    public List<Records> searchCompany (String companyName) {
    	Statement stmt;
    	String sql = "Select * from SalaryEngine where Company="+"'companName'";
    	System.out.println(sql);
    	List<Records> res = new ArrayList<Records> ();
    	try {
    		stmt = conn.createStatement();
    		ResultSet rs = stmt.executeQuery(sql);
    		while(rs.next()){
    			res.add(new Records(rs.getInt("Id"), rs.getString("Title"), rs.getString("FullDescription"), 
    					rs.getString("LocationNormalized"), rs.getString("ContractType"), rs.getString("ContractTime"),
    					rs.getString("Company"), rs.getString("Category"), rs.getInt("SalaryNormalized"), 
    					rs.getString("SourceName"),0));
            }
            rs.close();
            stmt.close();
    	} catch (SQLException e) {
        	e.printStackTrace();
        }
    	return res;
    }
    
    public List<Records> searchJob (String description, String location, String category, int salary) {
    	Statement stmt;
    	String sql = "Select * from SalaryEngine where Category="+"'companName'";
    	System.out.println(sql);
    	return null;
    }
    
    public void init() {
        try {
        	setPassword("XX");
            Class.forName(JDBC_DRIVER);
            System.out.println("Connecting to database...");
            conn = DriverManager.getConnection(DB_URL, "wc2467", password);
        } catch (Exception e) {
        	e.printStackTrace();
        }
    }

    public void bulkLoad() {
    	Statement stmt;
    	String sql = "LOAD DATA LOCAL INFILE 'data.csv' INTO TABLE Users"
    			+ " FIELDS TERMINATED BY ','  OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' "
    			+ "LINES TERMINATED BY '\\n' (@dummy, Title, Description, @dummy, Location, ContractType, ContractTime, Company)";
    	try {
    		stmt = conn.createStatement();
    		System.out.println(sql);
    		stmt.executeQuery(sql);
    		stmt.close();
    	} catch (SQLException e) {
    		System.out.println("1212");
    		e.printStackTrace();
    	}
    }
    
    private void createRecordsTable() {
        System.out.println("Creating table in given database...");
        Statement stmt;
        try {
            stmt = conn.createStatement();
            String sql = "CREATE TABLE Users "+
                    "(ID Integer NOT NULL AUTO_INCREMENT, " +
            		" (ID Integer," +
                    " Title VARCHAR, " +
                    " Description VARCHAR, " +
                    " Location VARCHAR, " +
                    " ContractType VARCHAR, " +
                    " ContractTime VARCHAR, " +
                    " Company VARCHAR, " +
                    " Category VARCHAR, " +
                    " Salary VARCHAR, " +
                    " SourceName VARCHAR, " +
                    " PRIMARY KEY ( UserID ))";
            stmt.executeUpdate(sql);
            stmt.close();
            System.out.println("Finished creating table Users");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
	
    private void createUsersTable() {
    	System.out.println("Creating table in given database...");
        Statement stmt;
        try {
            stmt = conn.createStatement();
            String sql = "CREATE TABLE Users "+
                    "(userID Integer NOT NULL AUTO_INCREMENT, " +
                    " Username VARCHAR(255), " +
                    " Password VARCHAR(255), " +
                    " Location VARCHAR(255), " +
                    " Category VARCHAR(255), " +
                    " Salary VARCHAR(255), " +
                    " Tele VARCHAR(255), " +
                    " Type VARCHAR(255), " +
                    " PRIMARY KEY ( UserID ))";
            System.out.println(sql);
            stmt.executeUpdate(sql);
            stmt.close();
            System.out.println("Finished creating table Users");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
    
    private void deleteTable(String name) {
        System.out.println("Deleting table in given database...");
        Statement stmt;
        try {
            stmt = conn.createStatement();
            String sql = "DROP TABLE " + name;
            stmt.executeUpdate(sql);
            stmt.close();
            System.out.println("Finished deleting table");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
    
    public boolean registerNewUser(String inputEmail, String inputPassword, String nickName) {
    	System.out.println("Rigerster new User "+inputEmail);
    	UserInfo user=selectUser(inputEmail);
    	if (user!=null)
    		return false;
    	Statement stmt;
    	try {
    		stmt = conn.createStatement();
    		String sql = "INSERT INTO Users (Email, Password, FaceBook, Nickname)"+
                    " VALUES ('"+inputEmail+"', '"+inputPassword+"', false, '"+nickName+"')";
    		stmt.executeUpdate(sql);
            stmt.close();
    	}
    	catch (SQLException e) {
            e.printStackTrace();
        } 
    	return true;
    }
   
    private void insert(String table) {
        System.out.println("Inserting into table " +table );
        Statement stmt;
        try {
            stmt = conn.createStatement();
            String sql = "INSERT INTO " +table + " (Username, Password, Location, Category, Salary, Tele, Type)"+
                        " VALUES ('carr@gmail.com', '123456', 'Dorking', 'Engineering', '30000', '1234567891', 'U')";

            stmt.executeUpdate(sql);
            stmt.close();
            System.out.println("Finished inserting into table");
        } catch (SQLException e) {
            e.printStackTrace();
        } 
    }
    
    public void selectAll(String table) {
    	String sql = "SELECT * FROM "+table;
    	System.out.println(sql);
    	Statement stmt;
    	try {
            stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(sql);
            while (rs.next()) {
            	int userId=rs.getInt("userID");
            	String username=rs.getString("Username");
            	String password=rs.getString("Password");
            	String location=rs.getString("Location");
            	String category=rs.getString("Category");
            	int salary=rs.getInt("Salary");
            	String tele=rs.getString("Tele");
            	String type=rs.getString("Type");
            	System.out.println("userId:"+userId+" username:"+username+" password:"+password+" location:"+location+
            			" category:"+category+" salary:"+salary+" tele:"+tele+" type:"+type);
            }
            rs.close();
            stmt.close();
        } catch (Exception e) {
        	System.err.println("Reconnect to database.");
            e.printStackTrace();
        }
    }
    
    public UserInfo selectUser(String inputEmail) {
    	String sql = "SELECT * from Users where Email='"+inputEmail+"'";
    	Statement stmt;
    	try {
            stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(sql);
            while(rs.next()){
            	int userID = rs.getInt("userID");
        		String email = rs.getString("Email");
        		String password = rs.getString("Password");
        		Boolean faceBook = rs.getBoolean("FaceBook");
        		String nickname = rs.getString("Nickname");
        		rs.close();
            	stmt.close();
    			return new UserInfo(userID,email,password,faceBook,nickname);
            }
    	}catch (Exception e) {
        	System.err.println("Reconnect to database.");
            e.printStackTrace();
        }
    	return null;
    }
    
    public UserInfo checkPassword(String inputEmail, String intputPassword) {
    	UserInfo userInfo=selectUser(inputEmail);
    	if (userInfo!=null && intputPassword.equals(userInfo.getPassword())) {
    		System.out.println("hi,"+userInfo.getNickname()+"~ you are loging in!");
    		return userInfo;
    	}
    	else return null;
    }
    
    public List<Records> recommmend(String username) {
    	String sql="select * from salaryengine where Id >= RAND() * (select max(Id) from salaryengine)"
    			+ " order by Id LIMIT 1000";
    	String sql1="select * from Users where Username='"+username+"'";
    	Statement stmt;
    	Statement stmt1;
    	List<Records> records=new ArrayList<Records>();
    	String userLocation="";
    	String userCategory="";
    	int userSalary=0;
    	
    	try {
            stmt1 = conn.createStatement();
            ResultSet rs1 = stmt1.executeQuery(sql1);
            
            
            
            while(rs1.next()) {
            	userLocation=rs1.getString("Location");
            	userCategory=rs1.getString("Category");
            	userSalary=rs1.getInt("Salary");
            }
            rs1.close();
        	stmt1.close();
    	} catch (Exception e) {
        	System.err.println("Reconnect to database.");
            e.printStackTrace();
        }
    	
    	try {
    		stmt = conn.createStatement();
    		ResultSet rs = stmt.executeQuery(sql);
            while(rs.next()){
            	int id=rs.getInt("Id");
            	String title=rs.getString("Title");
            	String description=rs.getString("FullDescription");
            	String location=rs.getString("LocationNormalized");
            	String contractType=rs.getString("ContractType");
            	String contractTime=rs.getString("ContractTime");
            	String company=rs.getString("Company");
            	String category=rs.getString("Category");
            	int salary=rs.getInt("SalaryNormalized");
            	String sourceName=rs.getString("SourceName");
            	double factor1=0.2;
            	double factor2=0.4;
            	double factor3=0.4;
            	double part1=0;
            	double part2=0;
            	double part3=0;
            	if (location.contains(userLocation)) 
            		part1=1;
            	if (category.contains(userCategory)) 
            		part2=1;
            	part3=helper.getSalaryPoint(userSalary, salary);
            	double similarity=part1*factor1+part2*factor2+part3*factor3;
            	DecimalFormat df=new DecimalFormat("0.0000"); 
            	similarity=Double.parseDouble(df.format(similarity));
            	if (records.size()<10) {
            		records.add(new Records(id, title, description, location, contractType, 
            				contractTime, company, category, salary, sourceName, similarity));
            		Collections.sort(records, new RecordsCompare());
            	}
            	else {
            		if (similarity>records.get(records.size()-1).similarity) {
            			records.remove(records.size()-1);
            			records.add(new Records(id, title, description, location, contractType,
            					contractTime, company, category, salary, sourceName, similarity));
            		}
            		Collections.sort(records, new RecordsCompare());
            	}
            }
            rs.close();
            stmt.close();
    	}catch (Exception e) {
        	System.err.println("Reconnect to database.");
            e.printStackTrace();
        }
    	return records;
    }
    
    private void createCommentsTable() {
    	System.out.println("Creating table in given database...");
        Statement stmt;
        try {
            stmt = conn.createStatement();
            String sql = "CREATE TABLE Comments "+
                    "(commentID Integer NOT NULL AUTO_INCREMENT, " +
                    " UserId Integer, " +
                    " CompanyName VARCHAR(255), " +
                    " Comments VARCHAR(255), " +
                    " Rank Integer, " +
                    " Date timestamp, " +
                    " PRIMARY KEY ( commentID ))";
            System.out.println(sql);
            stmt.executeUpdate(sql);
            stmt.close();
            System.out.println("Finished creating table Comments");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
    
    private void insertCommentsTable(int userId, String companyName, String comments, int rank, String date) {
    	System.out.println("Creating table in given database...");
        Statement stmt;
        try {
            stmt = conn.createStatement();
            String sql = "INSERT INTO Comments (UserId, CompanyName, Comments, Rank, Date) " + 
    				"VALUES ("+userId+", '"+companyName+"', '"+comments+"', "+rank+", '"+date+"')";
            System.out.println(sql);
            stmt.executeUpdate(sql);
            stmt.close();
            System.out.println("Finished creating table Comments");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
    
    public void selectAllComments() {
    	String sql = "SELECT * FROM Comments";
    	Statement stmt;
    	try {
            stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(sql);
            while(rs.next()){
                int commentId = rs.getInt("commentID");
                int userId = rs.getInt("UserId");
            	String companyName = rs.getString("CompanyName");
            	String comments = rs.getString("Comments");
            	int rank = rs.getInt("Rank");
            	String date = rs.getString("Date");
                System.out.println("commentID:"+commentId+" UserId:"+userId+" CompanyName:"+companyName+
                		" Comments:"+comments+" rank:"+rank+" date:"+date);
            }
            rs.close();
            stmt.close();
            conn.close();
        } catch (Exception e) {
        	System.err.println("Reconnect to database.");
            e.printStackTrace();
        }
    }
    
    public List<String> recommendCompany(int id) throws IOException, TasteException {
    	FileWriter fw = new FileWriter("ratings.csv");
    	Statement stmt;
    	Map<String, Integer> hs = new HashMap<String, Integer>();
    	Map<Integer, String> hs1 = new HashMap<Integer, String>();
    	try {
    		int tmp = 1;
    		stmt = conn.createStatement();
    		String sql = "select * from Comments";
    		ResultSet rs = stmt.executeQuery(sql);
    		while(rs.next()){
    			int userId = rs.getInt("UserId");
    			String companyName = rs.getString("CompanyName");
    			int companyId = 0;
    			if (hs.containsKey(companyName)) {
    				companyId = hs.get(companyName);
    			}
    			else {
    				companyId = tmp;
    				hs.put(companyName, companyId);
    				hs1.put(companyId, companyName);
    				tmp++;
    			}
    			int rank = rs.getInt("Rank");
    			String line = userId+","+companyId+","+rank;
    			fw.write(line);
    			fw.write("\n");
    		}
            stmt.close();
            fw.flush();
            fw.close();
            conn.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
		DataModel model=new FileDataModel(new File("ratings.csv"));
        UserSimilarity similarity =new EuclideanDistanceSimilarity(model);
        UserNeighborhood neighborhood=new ThresholdUserNeighborhood(0,similarity,model);
        UserBasedRecommender recommender=new GenericUserBasedRecommender(model,neighborhood,similarity);
        List<RecommendedItem> recommendations=recommender.recommend(id,10);
        List<String> res = new ArrayList<String>();
        for(RecommendedItem recommendation:recommendations) {
        	int company_id = (int) recommendation.getItemID();
        	String company_name = hs1.get(company_id);
        	res.add(company_name);
        }
		return res;
    }
}
