import sys

def main():
	flag=0
	while(flag==0):
		s=raw_input().split()
		a=int(s[0])
		b=int(s[1])
		c=int(s[2])
		if a==b==c==0:
			sys.exit(0)
			flag=1
		else:
			if b==(a+c)/2:
				cd=b-a
				print "AP ",
				ans=c+cd
			else:
				r=b/a
				print "GP ",
				ans=c*r

		print ans




main()
sys.exit(0)