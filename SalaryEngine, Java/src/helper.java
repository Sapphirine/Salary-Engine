
public class helper {
	public static void main(String[] args) {
		System.out.println(getSalaryPoint(10000,500000));
		System.out.println(getSalaryPoint(100000,500000));
		System.out.println(getSalaryPoint(1000,500000));
	}
	
	public static double getSalaryPoint(int userSalary, int salary) {
    	double res=1;
    	if (salary>=userSalary) {
    		int dis=salary-userSalary;
    		if (dis<=5000)
    			res=1;
    		else {
    			dis-=5000;
    			if (dis<=5000)
    				res=1-0.1*dis/5000;
    			else {
    				dis-=5000;
    				if (dis<=5000)
    					res=0.9-0.2*dis/5000;
    				else {
    					dis-=5000;
    					if (dis<=5000)
    						res=0.7-0.3*dis/5000;
    					else res=0.3;
    				}
    			}
    		}
    	}
    	else {
    		int dis=userSalary-salary;
    		if (dis<=5000) 
    			res=1-0.1*dis/5000;
    		else {
    			dis-=5000;
    			if (dis<=5000) 
    				res=0.9-0.3*dis/5000;
    			else {
    				dis-=5000;
   					if (dis<=5000)
    					res=0.6-0.5*dis/5000;
    				else res=0.05;
    			}
   			}
    	}
    	return res;
    }
}
