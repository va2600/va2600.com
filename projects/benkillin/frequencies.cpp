#include <iostream>
#include <math.h>
#include <vector>

/**
 * This program calculates and outputs the frequencies produced for various 
 * notes centered around A4 being at 440Hz.
 * 
 * @see http://www.physlink.com/Education/AskExperts/ae165.cfm?CFID=22766401&CFTOKEN=95f5dc74857103d7-0DC1E271-15C5-EE01-B9DD45445DDAB456 for an excellent explanation of the math used.
 * 
 * Included are some functions to map 0-1023 to the set of numbers -48 to 39 
 * using a 1-1 mapping. This is so this code can be incorporated easily into an
 * arduino microcontroller for a digitial synthesizer project I have been 
 * working on and off for about a year. 
 * 
 * @author benkillin
 * @date 19 November 2009
 * @version 1.0
 *
 * Copyright (c) 2009 benkillin
 *
 * This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

using namespace std;


/**
 * y = x/1023*87-48;
 * y = x/(x2-x1)*(y2-y1)-y1;
 */
double get_exponent(int n, int from, int num, int low);

/**
 * matlab function: linspace(-48,39, 1024)
 * d1 is first arg, d2 second arg, n is number of points)
 * y = [d1+(0:n-2)*(d2-d1)/(floor(n)-1) d2];
 * int i; for (i=0; i<=n-2; ++i) {  vec[i] = 
 *            d1+i*(d2-d1)/(floor(n)-1); } vec[i+1] = d2;
 */
vector<double> get_exponent_list(double d1, double d2, double n);

int
main(int argc, char** argv)
{
	double one12 = (double)1/(double)12;
	
	double dbl12throotof2 = (double)pow((double)2, one12);

	cout << dbl12throotof2;
	
	for(int i = 0; i < 1024; i++)
	{
		double tmp = get_exponent(i, 1023, 87, -48);
		double exp;
		
		if(tmp < 0)
		{
			exp = ceil(tmp);
		}
		else
		{
			exp = floor(tmp);
		}

		if(exp != -0)
		{
			double lambda = (double)(440)*(double)pow(dbl12throotof2, exp);
		
			cout << lambda << " ";
		}
	}
	
	cout << endl << endl;
	
/*	vector<double> list = get_exponent_list(-48, 39, 1024);
	
	cout << " SIZE: " << list.size() << endl << endl;

	for(int i = 0; i < list.size(); i++)
	{
		cout << list[i] << " ";
	}*/
	
	return 0;
}

double 
get_exponent(int n, int from, int num, int low)
{
	return (double)n / (double)from * (double)num + (double)low;
}

/**
 * matlab function: linspace(-48,39, 1024)
 * d1 is first arg, d2 second arg, n is number of points)
 * y = [d1+(0:n-2)*(d2-d1)/(floor(n)-1) d2];
 * int i; for (i=0; i<=n-2; ++i) {  vec[i] = 
 *            d1+i*(d2-d1)/(floor(n)-1); } vec[i+1] = d2;
 */
vector<double> 
get_exponent_list(double d1, double d2, double n)
{
	vector<double> retVal;

	for(int i = 0; i < fabs(n)-2; i++)
	{
		retVal.push_back(
			d1+i*(d2-d1)/(floor(n)-1)
		);
	}

	retVal.push_back(d2);
	
	return retVal;
}