

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.mahout.cf.taste.common.TasteException;

import com.google.gson.Gson;

/**
 * Servlet implementation class CompanyRecommender
 */
public class CompanyRecommender extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public CompanyRecommender() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		Gson gson = new Gson();
		response.setContentType("application/json"); 
		int userId = Integer.parseInt(request.getParameter("userId"));
		RdsLoader instance = RdsLoader.getInstance();
		instance.init();
		List<String> res = new ArrayList<String>();
		try {
			res = instance.recommendCompany(userId);
		} catch (TasteException e) {
			e.printStackTrace();
		}
		String ans = "";
		for (int i = 0; i < res.size(); i++) {
			ans = ans + res.get(i) + ",";
		}
		if (ans.length()!=0)
			ans.substring(0, ans.length() - 1);
		PrintWriter out=response.getWriter();
		out.println(ans);
		out.flush();
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		Gson gson = new Gson();
		response.setContentType("application/json"); 
		int userId = Integer.parseInt(request.getParameter("userId"));
		RdsLoader instance = RdsLoader.getInstance();
		instance.init();
		List<String> res = new ArrayList<String>();
		try {
			res = instance.recommendCompany(userId);
		} catch (TasteException e) {
			e.printStackTrace();
		}
		String ans = "";
		for (int i = 0; i < res.size(); i++) {
			ans = ans + res.get(i) + ",";
		}
		ans.substring(0, ans.length() - 1);
		PrintWriter out=response.getWriter();
		out.println(ans);
		out.flush();
	}

}
