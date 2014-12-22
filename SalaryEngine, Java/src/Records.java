
public class Records {
	public int id;
	public String title;
	public String description;
	public String location;
	public String contactType;
	public String contractTime;
	public String company;
	public String category;
	public int salary;
	public String sourceName;
	public double similarity;
	
	public Records (int id, String title, String description, String location, 
			String contactType, String contactTime, String company, String category,
			int salary, String sourceName, double similarity) {
		this.id=id;
		this.title=title;
		this.description=description;
		this.location=location;
		this.contractTime=contactTime;
		this.company=company;
		this.category=category;
		this.salary=salary;
		this.sourceName=sourceName;
		this.similarity=similarity;
	}
}
