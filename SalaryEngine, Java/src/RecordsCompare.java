import java.util.Comparator;


public class RecordsCompare implements Comparator<Records>{
	public int compare(Records A, Records B) {
		if (A.similarity>B.similarity)
			return -1;
		else {
			if (A.similarity==B.similarity)
				return 0;
			else return 1;
		}
	}
}
