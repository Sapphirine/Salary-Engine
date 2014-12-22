

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.google.gson.Gson;

/**
 * Servlet implementation class recommend
 */
public class recommend extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public recommend() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		Gson gson = new Gson();
		response.setContentType("application/json"); 
		String username=request.getParameter("user");
		if (username.contains("%40")) {
			username=username.replaceFirst("%40", "@");
		}
		System.out.println(username);
		RdsLoader instance = RdsLoader.getInstance();
		instance.init();
		List<Records> ans1 = instance.recommmend(username);
		Records res=ans1.get(0);
		System.out.println(ans1.size());
		PrintWriter out=response.getWriter();
		String ans=gson.toJson(ans1);
		System.out.println("1");
		out.println(ans);
		out.flush();
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		Gson gson = new Gson();
		response.setContentType("application/json"); 
		String keyword=request.getParameter("user");
		System.out.println(keyword);
		String username=keyword.substring(7);
		if (username.contains("%40")) {
			username=username.replaceFirst("%40", "@");
		}
		System.out.println(username);
		RdsLoader instance = RdsLoader.getInstance();
		instance.init();
		List<Records> result = instance.recommmend(username);
		System.out.println(result.size());
		PrintWriter out=response.getWriter();
		String ans=gson.toJson(result);
		System.out.println("1");
		out.println(ans);
		out.flush();
	}

}
